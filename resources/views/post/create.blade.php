@extends('layouts.app')

@section('title', 'Страница созднания поста')

@section('content')
    <form method="POST" action="{{route('post.store')}}" class="row g-3">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Название поста</label>
            <input name="title" type="text" value="{{old('title')}}" class="@error('title') is-invalid @enderror form-control" id="title">
            @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Контент поста</label>
            <textarea name="content" class="@error('content') is-invalid @enderror form-control" id="content" rows="6">{{old('content')}}</textarea>
            @error('content')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>


        <div class="col-md-3">
            <label for="category_id" class="form-label">Родительская категория</label>
            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" id="category_id" aria-describedby="category_id-validation">
                <option value="">Без родительской категории</option>
                @foreach ($categories->whereNull('parent_id') as $itemCategory)
                    @include('category.partials.category-list-select-create', ['itemCategory' => $itemCategory, 'level' => ''])
                @endforeach
            </select>
            @error('category_id')
            <div id="category_id-validation" class="invalid-feedback"> {{$message}}
                Пожалуйста, выберите корректную родительскую категорию.
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
    </form>
@endsection











