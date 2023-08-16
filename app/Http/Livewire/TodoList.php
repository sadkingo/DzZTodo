<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use App\Rules\ValidCollaborators;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class TodoList extends Component
    {
    public $user, $categories, $todoList, $search, $categorySearch;
    public $title, $category, $priority, $description, $collaborates, $dateDue;

    public function render()
        {
        $this->loadData();
        $this->applyFilters();

        return view('livewire.todo-list');
        }

    private function loadData()
        {
        $this->user = User::with(['tasks', 'tasks.categories'])->find(userId());
        $this->categories = Category::get();
        }

    private function applyFilters()
        {
        if ($this->search || $this->categorySearch)
            {
            $this->todoList = $this->user->tasks->filter(function ($task)
                {
                $foundInTitle = !$this->search || stripos($task->title, $this->search) !== false;
                $foundInCategories = !$this->categorySearch || $task->categories->filter(function ($category)
                    {
                    return stripos($category->name, $this->categorySearch) !== false;
                    })->isNotEmpty();
                return $foundInTitle && $foundInCategories;
                });
            } else
            {
            $this->todoList = $this->user->tasks;
            }
        }

    public function addTask()
        {
        $this->validateTaskInput();

        $task = $this->user->tasks()->create([
            'title'       => $this->title,
            'description' => $this->description,
            'created_by'  => userId(),
            'date_due'    => $this->dateDue,
            'priority'    => $this->priority ?? 'Low'
        ]);
        $task->categories()->attach($this->category ?? 1);

        $this->addCollaborators($task);

        $this->resetTaskFields();
        }

    private function validateTaskInput()
        {
        $this->validate([
            'title'        => 'required|min:3',
            'description'  => 'nullable',
            'collaborates' => ['nullable', new ValidCollaborators],
            'category'     => 'nullable|integer|exists:categories,id',
            'dateDue'      => 'required|date',
            'priority'     => 'nullable|in:' . implode(',', Task::PRIORITY_VALUES)
        ]);
        }

    private function addCollaborators($task)
        {
        if (!blank($this->collaborates))
            {
            foreach (explode(',', $this->collaborates) as $collaborate)
                {
                $task->taskUser()->attach(User::where('email', $collaborate)->first()->id);
                }
            }
        }

    private function resetTaskFields()
        {
        $this->title = '';
        $this->description = '';
        $this->collaborates = '';
        }


    public function deleteTask(int $id)
        {
        $task = Task::find($id);
        if ($task->created_by === userId())
            {
            $this->deleteTaskRelations($task);
            $task->delete();
            } else
            {
            throw ValidationException::withMessages(['You are not the owner']);
            }
        }

    private function deleteTaskRelations($task)
        {
        $categoryTaskIds = $task->categories()->allRelatedIds();
        $taskUsersIds = $task->taskUser()->allRelatedIds();

        $task->categories()->sync([]);
        $task->taskUser()->sync([]);

        foreach ($categoryTaskIds as $categoryId)
            {
            $task->categories()->updateExistingPivot($categoryId, ['deleted_at' => now()]);
            }

        foreach ($taskUsersIds as $taskUserId)
            {
            $task->taskUser()->updateExistingPivot($taskUserId, ['deleted_at' => now()]);
            }
        }

    public function priorityChange($id)
        {
        $task = Task::find($id);
        $newPriority = $this->getNextPriority($task->priority);
        $task->priority = $newPriority;
        $task->save();
        }

    private function getNextPriority($currentPriority)
        {
        $priorities = ['Low', 'Medium', 'High'];
        $currentIndex = array_search($currentPriority, $priorities);
        $nextIndex = ($currentIndex + 1) % count($priorities);
        return $priorities[$nextIndex];
        }

    public function statusChange($id)
        {
        $task = Task::find($id);
        $newStatus = $this->getNextStatus($task->status);
        $task->status = $newStatus;
        $task->save();
        }

    private function getNextStatus($currentStatus)
        {
        $statuses = ['Not Started', 'In Progress', 'Completed'];
        $currentIndex = array_search($currentStatus, $statuses);
        $nextIndex = ($currentIndex + 1) % count($statuses);
        return $statuses[$nextIndex];
        }

    public function categorySearch($category)
        {
        $this->categorySearch = $category;
        }

    }
