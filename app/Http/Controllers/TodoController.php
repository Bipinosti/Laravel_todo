<?php

namespace App\Http\Controllers;

use App\Todo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TodoController extends Controller
{

    // this wil change
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('todos.index', [
            'todos' => auth()->user()->todos()->paginate(5)
        ]);
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

        Todo::create([
            'name' => $request->newTaskName,
            'checked'=>$request->checked,
            'user_id' => auth()->user()->id
        ]);

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

    public function  checkbox($id)
    {
        $task = Todo::find($id);
        return view('todos.index')->with('checkRecord');
    }

    public function  updateCheckbox(Request $request, $id)
    {
        $task = Todo::find($id);
        $task->check = $request->updatedCheck;
        $task->save();
        return redirect()->route('todos.index');
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
