@php
    use Spatie\Html\Elements\Form;

@endphp

@extends('layouts.app')
@section('content')

@if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

{{ html()->modelForm($task, 'POST')->route('tasks.store')->open() }}


{{ html()->div()->class('form-group')->open() }}
{{ html()->Label(__('Автор'))->for('author')->class('control-label') }}
{{ html()->Input('text', 'author')->class('form-control')->value($task->creator->name ." (".$task->creator->email.")" )->disabled() }}
{{ html()->div()->close() }}

{{ html()->div()->class('form-group')->open() }}
{{ html()->Label(__('Виконавець'))->for('user_assigned_id')->class('control-label') }}
{{ html()->Input('text', 'user_assigned_id')->class('form-control')->value($task->user->name ." (".$task->user->email.")")->disabled() }}
{{ html()->div()->close() }}

{{ html()->div()->class('form-group')->open() }}
{{ html()->Label(__('Назва'))->for('title')->class('control-label') }}
{{ html()->Input('text', 'title')->class('form-control')->disabled() }}
{{ html()->div()->close() }}

{{ html()->div()->class('form-group')->open() }}
{{ html()->Label(__('Опис'))->for('description')->class('control-label') }}
{{ html()->Textarea('description')->class('form-control')->disabled() }}
{{ html()->div()->close() }}

{{ html()->div()->class('form-inline')->open() }}
    {{ html()->div()->class('form-group col-sm-4 removeleft')->open() }}
        {{ html()->Label(__('Крайній термін&nbsp;'))->for('deadline')->class('control-label') }}
        {{ html()->Input('date', 'deadline')->value($trim_date)->class('form-control')->disabled() }}
    {{ html()->div()->close() }}

        {{ html()->div()->class('form-group col-sm-4 removeleft removeright')->open() }}
            {{ html()->Label(__('Статус&nbsp;'))->for('status')->class('control-label select') }}
            {{ html()->Select('status')->options(App\Models\Task::getStatusesWithIds())->class('form-control')->disabled() }}
        {{ html()->div()->close() }}

{{ html()->div()->close() }}
<br/>
{{ html()->div()->class('form-group')->open() }}
{{ html()->a(route('tasks.index'),'Повернутись' )->class('btn btn-primary') }}
{{ html()->div()->close() }}

    {{ html()->closeModelForm() }}

@stop
