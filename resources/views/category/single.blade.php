@extends('layouts.app')

@section('title', 'Страница просмотра категории')

@section('content')
    <form class="row g-3">
        @csrf
        <fieldset disabled>
            <div class="mb-3">
                <label for="title" class="form-label">Название категории</label>
                <input name="title" type="text" value="{{$category->title}}" class="form-control" id="title">
            </div>

            <div class="col-md-3">
                <label for="parent_id" class="form-label">Родительская категория</label>
                <input name="parent_id" value="{{($category->parent === null) ? 'Без родительской категории' : $category->parent->title}}" class="form-control" id="parent_id" aria-describedby="parent_id-validation">
            </div>

        </fieldset>
    </form>
@endsection











