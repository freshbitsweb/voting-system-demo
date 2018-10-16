<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title'];

    /**
     * Get the votes for the user topic.
     */
    public function votes()
    {
        return $this->belongsToMany('App\User', 'topic_votes');
    }
}
