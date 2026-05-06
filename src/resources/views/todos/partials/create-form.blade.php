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
