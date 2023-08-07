<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Repositories\Task\TaskRepositoryContract;
use App\Repositories\User\UserRepositoryContract;
use Carbon\Carbon;

class TaskController extends Controller
{
    protected $request;
    protected $tasks;
    protected $users;

    public function __construct(
        TaskRepositoryContract $tasks,
        UserRepositoryContract $users
    )
    {
        $this->tasks = $tasks;
        $this->users = $users;

        // $this->middleware('tasks.create', ['only' => ['create']]);
        // $this->middleware('tasks.update.status', ['only' => ['updateStatus']]);
        // $this->middleware('tasks.assigned', ['only' => ['updateAssign', 'updateTime']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $tasks = Task::where('user_assigned_id', $user->id)
        ->where('status', '!=', 'done')
        ->get();
        $my_tasks = Task::where('user_created_id', $user->id)
        ->where('status', '!=', 'done')
        ->get();
        $complite_tasks = Task::where('status', 'done')
            ->where(function ($query) use ($user) {
                $query->where('user_created_id', $user->id)
                    ->orWhere('user_assigned_id', $user->id);
            })
            ->get();
        return view('tasks.index', compact('my_tasks','tasks','complite_tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // dd(Task::getStatusesWithIds());
        return view('tasks.create',['user' => auth()->user(),'task' =>'','rules' =>'editor'])
            ->withUsers($this->users->getAllUsersWithEmails());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $data = $request->all();
        $data['user_created_id'] = auth()->user()->id;
        Task::create($data); // Создаем задачу

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $trim_date = Carbon::parse($task->deadline)->format('Y-m-d');
        return view('tasks.show', compact('task','trim_date'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $user = auth()->user();
        $trim_date = Carbon::parse($task->deadline)->format('Y-m-d');
        $rules = '';
        if($task->user_created_id === $user->id){
            $rules = 'editor';
            return view('tasks.create', compact('task','user','trim_date','rules'))->withUsers($this->users->getAllUsersWithEmails());
        }elseif ($task->user_assigned_id === $user->id) {
            $rules = 'assigned';
            return view('tasks.create', compact('task','user','trim_date','rules'))->withUsers($this->users->getAllUsersWithEmails());
        }else{
            return redirect()->route('tasks.index')->with('error', 'У вас немає прав на редагування.Зверніться до Адміністратора.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTaskRequest $request, Task $task)
    {

        // dd($request->input());
        $user = auth()->user();
        if($task->user_created_id === $user->id){
            $task->update($request->all());
            return redirect()->route('tasks.index')->with('success', 'Завдання '.$task->title.' - відредаговано.');
        }else{
            $task->status = $request->status;
            $task->save();
            return redirect()->route('tasks.index')->with('error', 'У вас немає прав на редагування.Зверніться до Адміністратора.');;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $user = auth()->user();
        if($task->user_created_id === $user->id){
            $task->delete();
            return redirect()->route('tasks.index')->with('success', 'Завдання '.$task->title.' - видалено.');
        }else{
            return redirect()->route('tasks.index')->with('error', 'У вас немає прав на видалення.Зверніться до Адміністратора.');;
        }
    }
}
