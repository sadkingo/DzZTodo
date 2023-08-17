<?php

namespace App\Http\Livewire\Admin\Task;

use App\Models\Task;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
    {
    use WithFileUploads;

    public $task;

    public $created_by;
    public $title;
    public $category;
    public $description;
    public $collaborates;
    public $date_due;
    public $priority;
    public $status;

    protected $rules = [
        'created_by'  => 'required|numeric|exists:users,id',
        'title'       => 'required|string|min:3|max:255',
        'category'    => 'required|string',
        'category.*'  => 'exists:categories,id',
        'description' => 'nullable|string|min:3|max:255',
        'date_due'    => 'required|date',
        'priority'    => 'required|in:Low,Medium,High',
        'status'      => 'required|in:Not Started,In Progress,Completed',
    ];

    public function mount(Task $Task)
        {
        $this->task = $Task;
        $this->created_by = $this->task->created_by;
        $this->title = $this->task->title;
        $this->category = $this->task->category;
        $this->description = $this->task->description;
        $this->collaborates = $this->task->collaborates;
        $this->date_due = $this->task->date_due;
        $this->priority = $this->task->priority;
        $this->status = $this->task->status;
        }

    public function updated($input)
        {
        $this->validateOnly($input);
        }

    public function update()
        {
        if ($this->getRules())
            $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('UpdatedMessage', ['name' => __('Task')])]);

        $this->task->update([
            'created_by'  => $this->created_by,
            'title'       => $this->title,
            // 'category' => $this->category,
            'description' => $this->description,
            // 'collaborates' => $this->collaborates,
            'date_due'    => $this->date_due,
            'priority'    => $this->priority,
            'status'      => $this->status,
            // 'user_id' => auth()->id(),
        ]);

        $task = $this->task->refresh();

        $task->categories()->sync($this->category);
        $task->taskUser()->sync(User::where('id', $this->created_by)->get());

        $collaborates = explode(',', $this->collaborates);
        if (!blank($collaborates))
            {
            $collaboratorUsers = User::whereIn('email', $collaborates)->get();
            $task->taskUser()->attach($collaboratorUsers);
            }
        }


    public function render()
        {
        return view('livewire.admin.task.update', [
            'task' => $this->task
        ])->layout('admin::layouts.app', ['title' => __('UpdateTitle', ['name' => __('Task')])]);
        }
    }
