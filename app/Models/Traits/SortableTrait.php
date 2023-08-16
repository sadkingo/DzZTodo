<?php
namespace App\Models\Traits;

trait SortableTrait
{
    public function scopeOrderByPosition($query, $order = 'asc')
    {
        return $query->orderBy('position', $order);
    }
}
