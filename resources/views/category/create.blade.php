@extends('layouts.app')

@section('title', 'Страница создания категории')

@section('content')
    <form method="POST" action="{{route('category.store')}}" class="row g-3">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Название категории</label>
            <input name="title" type="text" value="{{old('title')}}" class="@error('title') is-invalid @enderror form-control" id="title">
            @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>


        <div class="col-md-3">
            <label for="parent_id" class="form-label">Родительская категория</label>
            <select name="parent_id" class="form-select @error('parent_id') is-invalid @enderror" id="parent_id" aria-describedby="parent_id-validation">
                <option value="">Без родительской категории</option>
                @foreach ($categories->whereNull('parent_id') as $itemCategory)
                    @include('category.partials.category-list-select-create', ['itemCategory' => $itemCategory, 'level' => ''])
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











