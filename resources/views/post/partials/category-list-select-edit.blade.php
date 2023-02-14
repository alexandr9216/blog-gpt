@php
$selected = ($itemCategory->id == old('category_id', $post->category->id ?? null)) ? 'selected' : '';
@endphp

<option value="{{$itemCategory->id}}" {{$selected}}>{{ $level . $itemCategory->title }}</option>

@php
$level .= '-- ';
@endphp

@foreach($categories->where('parent_id', $itemCategory->id) as $childrenCategories)
    @include('post.partials.category-list-select-edit', ['itemCategory' => $childrenCategories, 'level' => $level])
@endforeach






