<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
            'title',
            'description',
            'column_id',
            'created_by',
            'assigned_to',
            'priority',
            'order',
            'estimated_hours',
            'logged_hours'
        ];

    // Связи
    public function column()
    {
        return $this->belongsTo(Column::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function labels()
    {
        return $this->belongsToMany(Label::class, 'task_labels');
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}
