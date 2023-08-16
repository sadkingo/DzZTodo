<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
    {
    const PRIORITY_VALUES = ['Low', 'Medium', 'High'];
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'title',
        'description',
        'date_due',
        'priority',
        'status',
        'created_by',
    ];

    public function getDateDueAttribute()
        {
        return Carbon::parse($this->attributes['date_due'])->format('m/d/Y');
        }
    public function setDateDueAttribute($value)
        {
        $this->attributes['date_due'] = Carbon::parse($value)->format('Y-m-d');
        }
    public function users()
        {
        return $this->belongsTo(User::class, 'created_by');
        }
    public function taskUser()
        {
        return $this->belongsToMany(User::class)
            ->whereNull('task_user.deleted_at')
            ->withTimestamps();
        }

    public function categories()
        {
        return $this->belongsToMany(Category::class)
            ->whereNull('category_task.deleted_at')
            ->withTimestamps();
        }
    }
