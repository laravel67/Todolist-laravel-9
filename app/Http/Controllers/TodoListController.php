<?php

namespace App\Http\Controllers;

use App\Services\TodolistService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;

class TodoListController extends Controller
{
    protected $todolistservice;
    public function __construct(TodolistService $todolistService)
    {
        $this->todolistservice = $todolistService;
    }

    public function todolist(Request $request)
    {
        $todolist = $this->todolistservice->getTodoList();
        return view('todolist.index', [
            'title' => 'Todolist',
            'todolist' => $todolist
        ]);
    }

    public function add(Request $request)
    {
        $todo = $request->input("todo");
        if (empty($todo)) {
            $todolist = $this->todolistservice->getTodoList();
            return response()->view('todolist.index', [
                'title' => 'todolist',
                'todolist' => $todolist,
                'error' => "todolist is Required!"
            ]);
        }
        $this->todolistservice->saveTodo(uniqid(), $todo);
        return redirect()->action([TodoListController::class, 'todolist']);
    }

    public function remove(Request $request, string $id): RedirectResponse
    {
        $this->todolistservice->removeTodo($id);
        return redirect()->route('todolist');
    }
}
