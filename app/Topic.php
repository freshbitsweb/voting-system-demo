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

    /**
     * Returns the list of topics
     *
     * @return \Illuminate\Http\Collection
     **/
    public static function getList()
    {
        $topics = Topic::with('votes')->get();

        return $topics->transform(function ($topic) {
            $topic->isVoted = false;
            if ($topic->votes->contains('pivot.user_id', request()->user()->id)) {
                $topic->isVoted = true;
            }

            return $topic;
        });
    }
}
