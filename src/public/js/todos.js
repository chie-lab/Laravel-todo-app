const list = document.getElementById('todo-list');

if (list) {
    Sortable.create(list, {
        animation: 150,
        handle: '.drag-handle',
        ghostClass: 'todo-item-ghost',
        onEnd() {
            const ids = Array.from(list.querySelectorAll('.todo-item'))
                .map((el) => parseInt(el.dataset.id, 10));

            fetch(list.dataset.reorderUrl, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({ ids }),
            });
        },
    });
}
