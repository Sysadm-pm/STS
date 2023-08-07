<?php
namespace App\Repositories\Task;

interface TaskRepositoryContract
{

    public function find($id);

    public function create($requestData);

    public function updateStatus($id, $requestData);

    public function updateAssign($id, $requestData);

    public function tasks();

    public function allCompletedTasks();

    public function percantageCompleted();

    public function createdTasksMothly();

    public function completedTasksMothly();

    public function createdTasksToday();

    public function completedTasksToday();

    public function completedTasksThisMonth();

    public function totalOpenAndClosedTasks($id);
}
