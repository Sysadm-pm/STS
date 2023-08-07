@auth()
<h1>{{$title}}</h1>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Назва</th>
                <th>Виконавець</th>
                <th>Статус</th>
                <th>Крайній термін</th>
                <th>Дії</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->user->name  }}</td>
                    <td>{{ $task->status_text  }}</td>
                    <td>{{ $task->formatted_deadline  }}</td>
                    <td class="action-cell">
                        <a href="{{ route('tasks.show', $task) }}" class="btn btn-sm btn-info"><span data-feather="eye"></span></a>
                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-primary"><span data-feather="edit"></span></a>
                        @if (auth()->user()->id === $task->user_created_id)
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display: inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><span data-feather="trash-2"></span></button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endauth
