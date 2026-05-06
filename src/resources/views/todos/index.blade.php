@extends('layouts.app')

@section('title', 'Todo App')

@section('content')
    <div class="container">
        <div class="card">
            <h1>Todo App</h1>
            <p class="subtitle">まずはTodoの追加ができる最小構成です。</p>

            @include('todos.partials.alerts')

            @include('todos.partials.create-form')

            @if ($todos->isEmpty())
                <p class="empty">Todoはまだありません。最初の1件を追加してみましょう。</p>
            @else
                <ul id="todo-list" data-reorder-url="{{ route('todos.reorder') }}">
                    @foreach ($todos as $todo)
                        @include('todos.partials.todo-item', ['todo' => $todo])
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection
