<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';
    protected $primaryKey = 'idrole';
    public $timestamps = false;

    protected $fillable = [
        'idrole',
        'nama_role'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'idrole');
    }
}
