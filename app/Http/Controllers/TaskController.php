<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TaskController extends Controller
{

    public function __construct()
    {
        $this->database = app('firebase.database');
        $this->middleware('firebase');
    }

    public function index()
    {
        $tasks = $this->database->getReference('/tasks')->getValue();
        return view('index', compact('tasks'));
    }


    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $this->database->getReference('tasks')->push([
            'name' => $request->name,
        ]);

        session()->flash('notification', 'Task created successfully');

        return redirect()->route('task.index');
    }

    public function delete($key)
    {
        $this->database->getReference('tasks')->getChild($key)->remove();

        session()->flash('notification', 'Task deleted successfully');

        return redirect()->route('task.index');
    }
}
