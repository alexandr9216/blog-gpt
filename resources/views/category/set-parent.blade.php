@extends('layouts.app')

@section('title', 'Страница изменения родительской категории')

@section('content')
    <form method="POST" action="{{route('category.update-multiple')}}" class="row g-3">
        @csrf
        @method('PUT')
        <table class="table">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Название</th>
            </tr>
            </thead>
            <tbody>
            @foreach($childCategories as $childCategory)
                <tr>
                    <td scope="row">{{$childCategory->id}}</td>
                    <td>
                        <input name="categories[]" value="{{$childCategory->id}}" type="checkbox" checked="checked">
                        <a href="{{route('category.edit', $childCategory)}}">{{$childCategory->title}}</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="col-md-3">
            <label for="parent_id" class="form-label">Родительская категория</label>
            <select name="parent_id" class="form-select @error('parent_id') is-invalid @enderror" id="parent_id" aria-describedby="parent_id-validation">
                <option value="">Без родительской категории</option>
                @foreach ($categories->whereNull('parent_id') as $itemCategory)
                    @include('category.partials.category-list-select-set-parent', ['itemCategory' => $itemCategory, 'level' => ''])
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
    </form>
@endsection











