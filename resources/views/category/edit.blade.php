@extends('layouts.app')

@section('title', 'Страница редктирования категории')

@section('content')
    <form method="POST" action="{{route('category.update', $category->id)}}" class="row g-3">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="category-title" class="form-label">Название категории</label>
            <input name="title" type="text" value="{{old('title', $category->title)}}" class="@error('title') is-invalid @enderror form-control" id="category-title">
            @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-3">
            <label for="parent_id" class="form-label">Родительская категория</label>
            <select name="parent_id" class="form-select @error('parent_id') is-invalid @enderror" id="parent_id" aria-describedby="parent_id-validation">
                <option value="">Без родительской категории</option>
                @foreach ($categories->whereNull('parent_id') as $itemCategory)
                    @include('category.partials.category-list-select', ['itemCategory' => $itemCategory, 'level' => ''])
                @endforeach
            </select>
            @error('parent_id')
            <div id="parent_id-validation" class="invalid-feedback"> {{$message}}
                Пожалуйста, выберите корректную родительскую категорию.
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
    </form>
@endsection











