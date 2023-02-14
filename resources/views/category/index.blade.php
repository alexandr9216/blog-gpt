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

    <div class="row g-2">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{route('categories.index')}}">Категории</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{route('category.create')}}">Создать
                                категорию</a>
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
        <?php
        /*        function catRec($parent_id, $categories){
                    echo '<ul>';
                    foreach ($categories->where('parent_id', $parent_id) as $category){
                        echo '<li>'. $category->title .'</li>';
                        catRec($category->id, $categories);
                    }
                    echo '</ul>';
                }*/
        ?>

        {{--        @foreach($categories->whereNull('parent_id') as $category)
                    --}}{{--<input class="form-check-input me-1" type="checkbox" value="{{$category->id}}" aria-label="...">--}}{{--
                    {{$category->title}}<hr>
                    @php
                    \App\Http\Controllers\CategoryController::catRec2($category->id, $categories);
                    @endphp
                @endforeach--}}

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




    </div>
</div>


<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path
            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
    </symbol>
    <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
        <path
            d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
    </symbol>
    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path
            d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
    </symbol>
</svg>


</body>
</html>
