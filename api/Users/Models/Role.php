<?php

namespace Api\Users\Models;

use Api\Users\Models\User;
use Infrastructure\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_roles', 'user_id', 'role_id');
    }
}
