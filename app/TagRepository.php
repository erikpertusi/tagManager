<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TagRepository extends Model
{

    protected $table = 'tag_repository';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tag_id',
        'repository_id',
    ];

}
