<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $position;
    
    protected $rules = [
        'name' => 'required|string|min:3|max:255',
        'position' => 'required|numeric',        
    ];

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function create()
    {
        if($this->getRules())
            $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('CreatedMessage', ['name' => __('Category') ])]);
        
        Category::create([
            'name' => $this->name,
            'position' => $this->position,
            'user_id' => auth()->id(),
        ]);

        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.category.create')
            ->layout('admin::layouts.app', ['title' => __('CreateTitle', ['name' => __('Category') ])]);
    }
}
