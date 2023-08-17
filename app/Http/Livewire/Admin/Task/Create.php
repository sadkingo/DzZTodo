<?php

namespace App\Http\Livewire\Admin\Task;

use App\Models\Task;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $created_by;
    public $title;
    public $category;
    public $description;
    public $collaborates;
    public $date_due;
    public $priority;
    public $status;

    protected $rules = [
        'created_by' => 'required|numeric|exists:users,id',
        'title' => 'required|string|min:3|max:255',
        'category' => 'required|string',
        'category.*' => 'exists:categories,id',
        'description' => 'nullable|string|min:3|max:255',
        'date_due' => 'required|date',
        'priority' => 'required|in:Low,Medium,High',
        'status' => 'required|in:Not Started,In Progress,Completed',
    ];

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function create()
    {
        if($this->getRules())
            $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('CreatedMessage', ['name' => __('Task') ])]);

       $task = Task::create([
            'created_by' => $this->created_by,
            'title' => $this->title,
            'description' => $this->description,
            'date_due' => $this->date_due,
            'priority' => $this->priority,
            'status' => $this->status,
        ]);
        $task->categories()->attach($this->category ?? 1);
        $task->taskUser()->attach(User::where('id',$this->created_by)->first()->id);
        $this->addCollaborators($task);
        $this->reset();
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

    public function render()
    {
        return view('livewire.admin.task.create')
            ->layout('admin::layouts.app', ['title' => __('CreateTitle', ['name' => __('Task') ])]);
    }
}
