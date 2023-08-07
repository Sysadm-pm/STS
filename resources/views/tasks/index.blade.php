@extends('layouts.app')

@section('content')
    <a href="{{ route('tasks.create') }}" class="btn btn-sm btn-success"><span data-feather="plus-circle"></span> Створити завдання</a>
    @include('parts.table_index', ['title'=>'Створенні завдання.','tasks'=>$my_tasks])
    @include('parts.table_index', ['title'=>'Завдання для мене.','tasks'=>$tasks])
    @include('parts.table_index', ['title'=>'Завершені завдання','tasks'=>$complite_tasks])
@endsection
