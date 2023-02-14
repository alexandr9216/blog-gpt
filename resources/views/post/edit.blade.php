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

            <hr><h2>Создание поста</h2><hr>

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
            @if (Session::has('success'))
                <div class="alert alert-success d-flex align-items-center m-3" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                        <use xlink:href="#check-circle-fill"/>
                    </svg>
                    <div>
                        {{session('success')}}
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @foreach ($errors->all() as $message)
                <div class="alert alert-danger d-flex align-items-center m-3" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                        <use xlink:href="#check-circle-fill"/>
                    </svg>
                    <div>
                        {{$message}}
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endforeach
            <hr>

            <form method="POST" action="{{route('post.update', $post)}}" class="row g-3">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="title" class="form-label">Название поста</label>
                    <input name="title" type="text" value="{{old('title', $post->title)}}" class="@error('title') is-invalid @enderror form-control" id="title">
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Контент поста</label>
                    <textarea name="content" class="@error('content') is-invalid @enderror form-control" id="content" rows="6">{{old('content', $post->content)}}</textarea>
                    @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <div class="col-md-3">
                    <label for="category_id" class="form-label">Родительская категория</label>
                    <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" id="category_id" aria-describedby="category_id-validation">
                        <option value="">Без родительской категории</option>
                        @foreach ($categories->whereNull('parent_id') as $itemCategory)
                            @include('post.partials.category-list-select-edit', ['itemCategory' => $itemCategory, 'level' => ''])
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


        </div>
    </div>




    </body>
</html>
