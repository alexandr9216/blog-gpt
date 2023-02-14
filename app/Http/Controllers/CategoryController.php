<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Ramsey\Uuid\Type\Integer;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('parent')->get();
        return view('category.index', compact('categories'));
    }

    public function create(){
        $categories = Category::all();
        return view('category.create', compact('categories'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'title' => 'required|max:255',
            'parent_id' => 'nullable|integer|exists:categories,id'
        ]);

        $category = new Category;
        $category->title = $validated['title'];
        //$category->parent_id = null;

        if (isset($validated['parent_id'])) {
            $parentCategory = Category::find($validated['parent_id']);
            if ($parentCategory) {
                $category->parent_id = $validated['parent_id'];
            }
        }

        $category->save();

        return redirect()->route('category.edit', $category->id);
    }

    public function edit(Category $category){
        $categories = Category::all();
        return view('category.edit', compact('category','categories'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'parent_id' => 'nullable|integer|exists:categories,id'
        ]);

        $category->title = $validated['title'];
        $category->parent_id = null;

        if (isset($validated['parent_id'])) {
            $parentCategory = Category::find($validated['parent_id']);
            if ($parentCategory) {
                $category->parent_id = $validated['parent_id'];
            }
        }

        $category->save();

        return redirect()->route('category.edit', $category->id);
    }


    public function single(Category $category)
    {
        return view('category.single', compact('category'));
    }



    public function destroy(Category $category)
    {
        $category->children()->each(function (Category $catItem, $key) use ($category){
            if ($category->parent === null) {
                $catItem->parent()->disassociate();
            } else {
                $catItem->parent()->associate($category->parent);
            }
            $catItem->save();
        });

        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Категория успешно удалена');
    }

    public function destroyMultiple(Request $request){

        if (!$request->filled('categories')) {
            return back()->withErrors('Нет выбранных категорий');
        }

        $validated = $request->validate([
            'categories' => 'array',
            'categories.*' => 'required|integer|exists:categories,id',

        ]);


        if ($request['delete-children-categories']) {

            //ver3.1 Отсоединяем посты от категорий, которые удаляем
            //(за 1 sql запрос)
            /*
            $queryСategories = Category::query();
            $queryСategories->select('id')
                //->from('categories')
                ->whereIn('parent_id', $validated['categories'])
                ->orWhereIn('id', $validated['categories']);
            ddd($queryСategories);
            Post::whereIn('category_id', $queryСategories)->update(['category_id' => null]);
            */

            //ver3.0 Отсоединяем посты от категорий, которые удаляем
            //(за 1 sql запрос)
            Post::whereIn('category_id', function ($query) use ($validated){
                $query->select('id')
                    ->from('categories')
                    ->whereIn('parent_id', $validated['categories'])
                    ->orWhereIn('id', $validated['categories']);
            })->update(['category_id' => null]);



            //ver2 Отсоединяем посты от категорий, которые удаляем
            //(за 2 sql запрос)
            //$categories = Category::whereIn('parent_id', $validated['categories'])->orWhereIn('id', $validated['categories'])->get();
            //Post::whereIn('category_id', $categories->pluck('id'))->update(['category_id' => null]);

            //ver1 Отсоединяем посты от категорий, которые удаляем
            //(за много sql запросов)
            /*$categories = Category::with('posts', 'children.posts')->whereIn('id', $validated['categories'])->get();
            //ddd($categories);
            foreach ($categories as $category){
                //устанавливаем для каждого поста category_id в null
                //Одним sql запросом
                if ($category->posts->isNotEmpty()) {
                    $category->posts()->update(['category_id' => null]);
                }
                //выбераем каждую дочернюю категорию, выбраных категорий и устанавливаем для каждого поста дочерней категории category_id в null
                foreach ($category->children as $children){
                    if ($children->posts->isNotEmpty()) {
                        $children->posts()->update(['category_id' => null]);
                    }
                }
            }*/

            //ver gpt chat bot
            /*$categories = Category::with('posts', 'children.posts')->whereIn('id', $validated['categories'])->get();

            $postIds = $categories->flatMap(function ($category) {
                return $category->posts->pluck('id');
            })->concat($categories->flatMap(function ($category) {
                return $category->children->flatMap(function ($child) {
                    return $child->posts->pluck('id');
                });
            }));

            Post::whereIn('id', $postIds)->update(['category_id' => null]);*/

        } else {

            //ver2 Отсоединяем дочерние категориии от тех категорий, которые удаляем
            Category::whereIn('parent_id', $validated['categories'])->update(['parent_id' => null]);

            //ver1 Отсоединяем дочерние категориии от тех категорий, которые удаляем
            /*$categories = Category::whereIn('id', $validated['categories'])->get();

            foreach ($categories as $category) {
                $subCategories = Category::where('parent_id', $category->id)->get();

                foreach ($subCategories as $subCategory) {
                    $subCategory->parent_id = null; //или так: $subCategory->parent()->disassociate();
                    $subCategory->save();
                }
            }*/
        }

        //ver1 удаляем выбранные категории
        //Category::destroy($validated['categories']);//Здесь будет столько sql запросов для удаления, сколько id в массиве
        //ver2 удаляем выбранные категории
        //--Category::whereIn('id', $validated['categories'])->delete();//Сделает удаление всех id одним sql запросом

        return redirect()->route('categories.index')->with('success', 'Категория успешно удалена');
    }

    public function updateMultiple(Request $request){

        if (!$request->filled('categories')) {
            return redirect()->route('categories.index')->withErrors('Нет выбранных категорий');
        }

        $validated = $request->validate([
            'categories' => 'array',
            'categories.*' => 'required|integer|exists:categories,id',
            'parent_id' => 'nullable|integer|exists:categories,id',
        ]);

        if ($request->has('parent_id')) {
            Category::whereIn('id', $validated['categories'])->update(['parent_id' => $validated['parent_id']]);
            return redirect()->route('categories.index')->withSuccess('Категории успешно обновлены');
        }


        //dd($validated['categories']);
        $categories = Category::all();
        $childCategories = Category::whereIn('id', $validated['categories'])->get();
        //dd($categories);
        return view('category.set-parent', ['childCategories' => $childCategories, 'categories' => $categories]);

    }

}
