@php
    use Spatie\Html\Elements\Form;

@endphp

@extends('layouts.app')
@section('content')
@if ($task)
<h1>Редагувати</h1>
{{ html()->modelForm($task, 'PUT')->route('tasks.update',$task->id)->open() }}
@else
<h1>Створити</h1>
{{ html()->modelForm($task, 'POST')->route('tasks.store')->open() }}
@endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif



{{ html()->div()->class('form-group')->open() }}
{{ html()->Label(__('Назва'))->for('title')->class('control-label') }}
{{ html()->Input('text', 'title')->class('form-control')->attributes( ($rules !== 'editor')?['readonly']:[] ) }}
{{ html()->div()->close() }}

{{ html()->div()->class('form-group')->open() }}
{{ html()->Label(__('Опис'))->for('description')->class('control-label') }}
{{ html()->Textarea('description')->class('form-control')->attributes(($rules !== 'editor')?['readonly']:[]) }}
{{ html()->div()->close() }}

{{ html()->div()->class('form-inline')->open() }}
    {{ html()->div()->class('form-group col-sm-4 removeleft')->open() }}
        {{ html()->Label(__('Крайній термін&nbsp;'))->for('deadline')->class('control-label') }}
        @if ($task)
        {{ html()->Input('date', 'deadline')->value($trim_date)->class('form-control')->attributes(($rules !== 'editor')?['readonly']:[]) }}
        @else
        {{ html()->Input('date', 'deadline')->value(\Carbon\Carbon::now()->addDays(3)->format('Y-m-d'))->class('form-control') }}

        @endif
    {{ html()->div()->close() }}

        {{ html()->div()->class('form-group col-sm-4 removeleft ')->open() }}
            {{ html()->Label(__('Статус&nbsp;'))->for('status')->class('control-label select') }}
            {{ html()->Select('status')->options(App\Models\Task::getStatusesWithIds())->class('form-control') }}

        {{ html()->div()->close() }}
        {{ html()->div()->class('form-group col-sm-4 removeright')->open() }}
                {{ html()->Label(__('Виконавець&nbsp;'))->for('user_assigned_id')->class('control-label') }}
            @if($rules === 'editor')
            {{ html()->Select('user_assigned_id', $users)->class('form-control') }}
            @else
            {{ html()->Select('user_assigned_id', [$task->user_assigned_id => $user->name])->class('form-control')->attributes(($rules !== 'editor')?['readonly']:[]) }}
            @endif
        {{ html()->div()->close() }}
{{ html()->div()->close() }}
<br/>
    {{ html()->div()->class('form-group')->open() }}
    @if ($task)
        {{ html()->Input('submit')->class('btn btn-success btn-sm removeleft')->value('Редагувати') }}
    @else
        {{ html()->Input('submit')->class('btn btn-success btn-sm removeleft')->value('Створити') }}
    @endif
        {{ html()->a(route('tasks.index'),'Повернутись' )->class('btn btn-sm btn-primary removeright') }}
    {{ html()->div()->close() }}

    {{ html()->closeModelForm() }}

@stop
