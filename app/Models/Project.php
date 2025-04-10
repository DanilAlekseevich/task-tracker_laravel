<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name', 'description', 'created_by',
    ];

    // Связи
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'project_users')->withPivot('role');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function boards()
    {
        return $this->hasMany(Board::class);
    }

    public function addUser($user, $role)
    {
        if (is_numeric($user)) {
            $user = User::findOrFail($user);
        }
        $this->users()->syncWithoutDetaching([$user->id => ['role' => $role]]);
    }

    public function removeUser($user)
    {
        if (is_numeric($user)) {
            $user = User::findOrFail($user);
        }
        $this->users()->detach($user->id);
    }
}
