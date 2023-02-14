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

        <hr><h2>Просмотр</h2><hr>

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


    </div>
</div>




</body>
</html>