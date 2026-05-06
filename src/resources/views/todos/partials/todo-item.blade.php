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
