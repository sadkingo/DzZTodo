<?php

namespace App\Http\Livewire\Admin\Task;

use App\Models\Task;
use Livewire\Component;

class Single extends Component
    {

    public $task;

    public function mount(Task $Task)
        {
        $this->task = $Task;
        }

    public function delete()
        {
        $this->deleteTaskRelations($this->task);
        $this->task->delete();
        $this->dispatchBrowserEvent('show-message', ['type' => 'error', 'message' => __('DeletedMessage', ['name' => __('Task')])]);
        $this->emit('taskDeleted');
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

    public function render()
        {
        return view('livewire.admin.task.single')
            ->layout('admin::layouts.app');
        }
    }
