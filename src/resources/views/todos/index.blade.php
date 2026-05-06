<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Todo App</title>
        <link rel="stylesheet" href="{{ asset('css/todos.css') }}">
    </head>
    <body>
        <div class="container">
            <div class="card">
                <h1>Todo App</h1>
                <p class="subtitle">まずはTodoの追加ができる最小構成です。</p>

                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-error">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('todos.store') }}" method="POST">
                    @csrf
                    <input
                        type="text"
                        name="title"
                        placeholder="例: 牛乳を買う"
                        value="{{ old('title') }}"
                        maxlength="255"
                    >
                    <button type="submit">追加</button>
                </form>

                @if ($todos->isEmpty())
                    <p class="empty">Todoはまだありません。最初の1件を追加してみましょう。</p>
                @else
                    <ul>
                        @foreach ($todos as $todo)
                            <li class="todo-item">
                                <form class="todo-item-form" action="{{ route('todos.update-completion', $todo) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="is_completed" value="0">
                                    <input
                                        type="checkbox"
                                        name="is_completed"
                                        value="1"
                                        @checked($todo->is_completed)
                                        onchange="this.form.submit()"
                                        aria-label="{{ $todo->title }}を完了にする"
                                    >
                                </form>
                                <span class="dot {{ $todo->is_completed ? 'dot-completed' : '' }}"></span>
                                <span class="todo-title {{ $todo->is_completed ? 'todo-title-completed' : '' }}">{{ $todo->title }}</span>
                                <form class="todo-delete-form" action="{{ route('todos.destroy', $todo) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-button">削除</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </body>
</html>
