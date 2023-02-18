@extends('layouts.app')

@section('title', 'Страница постов')

@section('content')
    <table class="table post">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Название</th>
            <th scope="col">Родильская категория</th>
            <th class="btn-edit" scope="col">Редактировать</th>
            <th class="btn-trash" scope="col">Удалить</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
                <td scope="row">{{$post->id}}</td>
                <td><a href="{{route('post.edit', $post)}}">{{$post->title}}</a></td>
                <td>
                    @if ($post->category === null)
                        Без родительской категории
                    @else
                        <a href="{{route('category.edit', $post->category)}}">{{$post->category->title}}</a>
                    @endif
                </td>
                <td class="btn-edit"><a href="{{route('post.edit', $post)}}"><i class="bi bi-pencil-square"></i></a></td>
                <td class="btn-trash">
                    <a href="#"
                       onclick="event.preventDefault();
                            if (confirm('Вы действительно хотите удалить этот пост?')) {
                                document.getElementById('delete-form-{{ $post->id }}').submit();
                            }">
                        <i class="bi bi-x-circle-fill"></i>
                    </a>

                    <form id="delete-form-{{ $post->id }}" action="{{ route('post.destroy', $post) }}"
                          method="post" style="display: none;">
                        @csrf
                        @method('delete')
                    </form>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection











