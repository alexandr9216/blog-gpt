<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">


</head>
<body class="antialiased">

<div class="container overflow-hidden">
    <div class="row g-2">

        <hr><h2>Редактирование</h2><hr>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{route('categories.index')}}">Категории</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{route('category.create')}}">Создать категорию</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{route('posts.index')}}">Посты</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{route('post.create')}}">Создать пост</a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>
        <hr>

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


    </div>
</div>




</body>
</html>
