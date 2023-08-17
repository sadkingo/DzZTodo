<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public $user;

    public $name;
    public $username;
    public $email;
    public $password;
    public $user_type;
    
    protected $rules = [
        'name' => 'required|string|min:3|max:255',
        'username' => 'required|string|min:3|max:255',
        'email' => 'required|email|min:3|max:255|unique:users,email',
        'password' => 'required|string',
        'user_type' => 'required|in:user,admin',        
    ];

    public function mount(User $User){
        $this->user = $User;
        $this->name = $this->user->name;
        $this->username = $this->user->username;
        $this->email = $this->user->email;
        $this->password = $this->user->password;
        $this->user_type = $this->user->user_type;        
    }

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function update()
    {
        if($this->getRules())
            $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('UpdatedMessage', ['name' => __('User') ]) ]);
        
        $this->user->update([
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password,
            'user_type' => $this->user_type,
            'user_id' => auth()->id(),
        ]);
    }

    public function render()
    {
        return view('livewire.admin.user.update', [
            'user' => $this->user
        ])->layout('admin::layouts.app', ['title' => __('UpdateTitle', ['name' => __('User') ])]);
    }
}
