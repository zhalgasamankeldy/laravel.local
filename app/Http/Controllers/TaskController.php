<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    protected $user_id;


     public function __construct(Guard $user)
     {
         $this->user_id = $user->id();
     }
    public function index()
    {
        //$tasks = Task::where('user_id','=',$this->user_id)->orderBy('created_at','ask')->get();
        return view('task.index',[
            'tasks'=>Task::getTasksByUser($this->user_id)    
        ]);
    }

    public function create()
    {
        return view('task.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
           'task'=>'required|max:255'
        ]);
        $request->user()->tasks()->create([
            'name'=>$request->task
        ]);

        return redirect('/tasks');
    }

    public function edit(Request $request, Task $task)
    {
        return view('task.edit',[
            'task'=>$request->task
        ]);
    }

    public function update($task, Request $request, Task $tasks)
    {
        $this->validate($request,[
            'task'=>'required|max:255'
        ]);

        $update = $tasks::where('id','=',$task)->firstOrFail();
        $this->authorize('destroy',$update);
        $update->name=$request->task;
        $update->save();

        return redirect('/tasks');
    }

    public function destroy(Task $task)
    {
        $this->authorize('destroy',$task);
        $task->delete();

        return redirect('/tasks');
    }
}
