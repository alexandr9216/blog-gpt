@extends('layouts.app')

@section('title', 'Страница постов')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Название</th>
            <th scope="col">Родильская категория</th>
            <th scope="col">Удалить</th>
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
                <td>
                    <a href="#"
                       onclick="event.preventDefault();
                            if (confirm('Вы действительно хотите удалить этот пост?')) {
                                document.getElementById('delete-form-{{ $post->id }}').submit();
                            }">
                        Удалить
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











