<?php

namespace App\CRUD;

use App\Models\Category;
use EasyPanel\Contracts\CRUDComponent;
use EasyPanel\Parsers\Fields\Field;
use App\Models\Task;

class TaskComponent implements CRUDComponent
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
        return Task::class;
        }

    // which kind of data should be showed in list page
    public function fields()
        {
        return ['title', 'description', 'date_due', 'priority', 'status', 'created_by'];
        }

    // Searchable fields, if you dont want search feature, remove it
    public function searchable()
        {
        return ['title', 'description', 'date_due', 'priority', 'status', 'created_by'];
        }

    // Write every fields in your db which you want to have a input
    // Available types : "ckeditor", "checkbox", "text", "select", "file", "textarea"
    // "password", "number", "email", "select", "date", "datetime", "time"
    public function inputs()
        {
        return [
            'created_by'   => 'number',
            'title'        => 'text',
            'category'     => ['select' => Category::pluck('name', 'id')->toArray()],
            'description'  => 'textarea',
            'collaborates' => 'textarea',
            'date_due'     => 'date',
            'priority'     => ['select' => ['Low' => 'Low', 'Medium' => 'Medium', 'High' => 'High']],
            'status'       => ['select' => ['Not Started' => 'Not Started', 'In Progress' => 'In Progress', 'Completed' => 'Completed']],
        ];
        }

    // Validation in update and create actions
    // It uses Laravel validation system
    public function validationRules()
        {
        return [
            'created_by'  => 'required|numeric|exists:users,id',
            'title'       => 'required|string|min:3|max:255',
            'category'    => 'required|string|exists:categories,id',
            'description' => 'nullable|string|min:3|max:255',
            'date_due'    => 'required|date',
            'priority'    => 'required|in:Low,Medium,High',
            'status'      => 'required|in:Not Started,In Progress,Completed',
        ];
        }

    // Where files will store for inputs
    public function storePaths()
        {
        return [];
        }
    }
