<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    //

    /**
     * Get the votes for the user topic.
     */
    public function votes()
    {
        return $this->belongsToMany('App\User', 'topic_votes');
    }
}
