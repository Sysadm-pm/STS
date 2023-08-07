@auth()
<nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('tasks.index') }}">
                    <span data-feather="home"></span>
                    Дошка завдань <span class="sr-only">(current)</span>
                </a>
            </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Створити завдання</span>
            <a class="d-flex align-items-center text-success" href="{{ route('tasks.create') }}">
                <span data-feather="plus-circle"></span>
            </a>
        </h6>

    </div>
</nav>

@endauth
