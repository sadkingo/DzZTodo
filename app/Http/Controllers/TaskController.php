<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskUpdateRequest;
use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
    {
    /**
     * Display a listing of the resource.
     */
    public function index()
        {
        abort(404);
        }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
        {
        abort(404);
        }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
        {
        abort(404);
        }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
        {
        abort(404);
        }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
        {
        $task = Task::with('categories', 'taskUser')->findOrFail($id);
        $categories = Category::get();
        return view('Task.edit', compact('task', 'categories'));
        }


    /**
     * Update the specified resource in storage.
     */
    public function update(TaskUpdateRequest $request, string $id)
        {
        // $request = $request->validated();
        $task = Task::with('categories', 'taskUser')->find($id);

        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->date_due = $request->input('dueDate');

        $selectedCategories = [];
        foreach ($request->all() as $fieldName => $fieldValue)
            {
            if (strpos($fieldName, 'category') === 0 && $fieldValue === 'on')
                {
                $categoryId = substr($fieldName, strlen('category'));

                $selectedCategories[] = $categoryId;
                }
            }
        $task->categories()->sync($selectedCategories);

        $collaborates = explode(',', $request->input('collaborates'));
        $collaboratorUsers = User::whereIn('email', $collaborates)->get();
        $task->taskUser()->sync($collaboratorUsers->push(authUser()));

        $task->save();

        return redirect()->back();
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
        {
        abort(404);
        }
    }
