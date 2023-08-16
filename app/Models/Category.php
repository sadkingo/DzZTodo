<?php

namespace App\Models;

use App\Models\Traits\SortableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
        use HasFactory,SoftDeletes,SortableTrait;
    protected $fillable = [
        'name',
        'position',
    ];
    public function tasks()
        {
        return $this->belongsToMany(Task::class)
        ->whereNull('category_task.deleted_at')
        ->withTimestamps();
        }
    }
