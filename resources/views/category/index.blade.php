@extends('layouts.app')

@section('title', 'Страница категорий')

@section('content')
    <form method="POST" action="{{route('category.update-multiple')}}">
        @csrf
        <table class="table table-hover table-bordered">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Название</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories->whereNull('parent_id') as $category)
                @include('category.partials.category-list-table', ['category' => $category, 'level' => 0])
            @endforeach
            </tbody>
        </table>

        <div class="mb-3">
            <label for="_method" class="form-label">Действие</label>
            <select name="_method" class="form-select" id="_method" aria-describedby="">
                <option value="delete">Удалить</option>
                <option value="put">Изменить родительскую категорию</option>
            </select>
            <button type="submit" class="btn btn-primary">Применить</button>
        </div>
        <label for="delete-children-categories" class="form-label">Удалять внутренние категории</label>
        <input name="delete-children-categories" class="form-check-input me-1" type="checkbox"
               id="delete-children-categories" value="1" aria-label="...">

    </form>
@endsection







