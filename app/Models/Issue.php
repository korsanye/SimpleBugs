<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Michelf\MarkdownExtra;

class Issue extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'project_id', 'category_id', 'priority_id', 'milestone_id', 'created_by', 'title', 'description', 'estimate'];

    protected $dates = ['deleted_at'];

    public function project()
    {
        return $this->belongsTo(\App\Models\Project::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function posts()
    {
        return $this->hasMany(\App\Models\Post::class);
    }

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }

    public function priority()
    {
        return $this->belongsTo(\App\Models\Priority::class);
    }

    public function milestone()
    {
        return $this->belongsTo(\App\Models\Milestone::class);
    }

    public function getCreatedByAttribute($value)
    {
        return User::withTrashed()->findOrFail($value);
    }
}
