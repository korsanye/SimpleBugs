<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    public $timestamps = false;

    protected $table = 'priorities';

    protected $fillable = ['name', 'sort', 'default'];

    public function issues()
    {
        return $this->hasMany(\App\Models\Issue::class);
    }

}
