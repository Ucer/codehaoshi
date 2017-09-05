<?php

namespace App\Models\Traits;

trait BaseFilterable
{

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}