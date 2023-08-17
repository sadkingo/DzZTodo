<?php
namespace App\Models\Traits;

trait SortableTrait
    {
    public static function bootSortableTrait()
        {
        static::addGlobalScope('position', function ($query)
            {
            $query->orderBy('position', 'desc');
            });
        }
    }
