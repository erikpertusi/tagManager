<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Tag extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'user_id'
    ];

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            TagRepository::where('tag_id', $model->id)->delete();
        });
    }

    public function tagsByUser()
    {
        return $this->where('user_id', Auth::user()->id);
    }

    public function repositories()
    {
        return $this->belongsToMany('App\Repository', 'tag_repository', 'tag_id', 'repository_id');
    }

}
