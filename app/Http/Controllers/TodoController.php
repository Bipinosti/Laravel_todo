<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TodoController extends Controller
{

    public function index()
    {
        $tasks = Todo::orderBy('id','desc')->paginate(5);
        return view('todos.index')->with('storedTasks', $tasks);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'newTaskName' => 'required|min:5|max:255',
        ]);
        $task = new Todo;
        $task->name = $request->newTaskName;
        $task->save();
        Session::flash('success', 'New task has been succesfully added!');
        return redirect()->route('todos.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $task = Todo::find($id);
        return view('todos.edit')->with('taskUnderEdit', $task);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'updatedTaskName' => 'required|min:5|max:255',
        ]);
        $task = Todo::find($id);
        $task->name = $request->updatedTaskName;
        $task->save();
        Session::flash('success', 'Task #' . $id . ' has been successfully updated.');
        return redirect()->route('todos.index');
    }

    public function destroy($id)
    {
        $task = Todo::find($id);
        $task->delete();
        Session::flash('success', 'Task #' . $id . ' has been successfully deleted.');
        return redirect()->route('todos.index');
    }
}
