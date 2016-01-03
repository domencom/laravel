<?php namespace App\Http\Controllers;

use App\Services\GeoCode\Config;
use Illuminate\Http\Request;
use App\Model\Task;
use App\Http\Requests\CreateTask;

class TasksController extends Controller {

    public function tasks(Config $config)
    {
        $tasks = Task::orderBy('created_at', 'desc')->get();
        return view('tasks.tasks', compact('tasks'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function task($id)
    {
        Task::findOrFail($id)->delete();
        return redirect('tasks');
    }

    /**
     * @param CreateTask $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function add(CreateTask $request)
    {
        $task = new Task;
        $task->name = $request->name;
        $task->save();

        return redirect('tasks');
    }

    /**
     *
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    public function update($id, Request $request)
    {
        $task = Task::findOrFail($id);
        $task->name =  $request->input('name');
        $task->save();

        return redirect('tasks');
    }
}
