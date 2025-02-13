<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    protected $fillable = [
        'name', 'color',
    ];

    // Связи
    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'task_labels');
    }
}
