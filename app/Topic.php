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
    protected $fillable = ['title', 'user_id'];

    /**
     * Get the votes for the user topic.
     */
    public function votes()
    {
        return $this->belongsToMany('App\User', 'votes', 'topic_id', 'user_id');
    }

    /**
     * Get the user for the topic.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
