<?php

namespace App\CRUD;

use EasyPanel\Contracts\CRUDComponent;
use EasyPanel\Parsers\Fields\Field;
use Illuminate\Validation\Rules;
use App\Models\User;

class UserComponent implements CRUDComponent
{
    // Manage actions in crud
    public $create = true;
    public $delete = true;
    public $update = true;

    // If you will set it true it will automatically
    // add `user_id` to create and update action
    public $with_user_id = true;

    public function getModel()
    {
        return User::class;
    }

    // which kind of data should be showed in list page
    public function fields()
    {
        return ['name', 'email',  'password','username', 'user_type'];
    }

    // Searchable fields, if you dont want search feature, remove it
    public function searchable()
    {
        return ['name', 'email', 'password','username', 'user_type'];
    }

    // Write every fields in your db which you want to have a input
    // Available types : "ckeditor", "checkbox", "text", "select", "file", "textarea"
    // "password", "number", "email", "select", "date", "datetime", "time"
    public function inputs()
    {
        return [
            'name'=>'text',
            'username'=>'text',
            'email'=>'email',
            'password' => 'password',
            'user_type'=>['select'=>['user'=>'user','admin'=>'admin']],
        ];
    }

    // Validation in update and create actions
    // It uses Laravel validation system
    public function validationRules()
    {
        return [
            'name' =>'required|string|min:3|max:255',
            'username' =>'required|string|min:3|max:255',
            'email' => 'required|email|min:3|max:255|unique:users,email',
            'password' => 'required|string',
            'user_type' =>'required|in:user,admin',

        ];
    }

    // Where files will store for inputs
    public function storePaths()
    {
        return [];
    }
}
