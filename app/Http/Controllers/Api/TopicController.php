<?php

namespace App\Http\Controllers\Api;

use App\Topic;
use App\Http\Controllers\Controller;

class TopicController extends Controller
{
    /**
     * Returns the list of the topics
     *
     * @return Json
     **/
    public function index()
    {
        $topics = Topic::getList();

        $topics->transform(function ($topic) {
            $topic->isVoted = false;
            if ($topic->votes->contains('pivot.user_id', request()->user()->id)) {
                $topic->isVoted = true;
            }

            return $topic;
        });

        return [
            'topics' => $topics,
            'user' => request()->user()
        ];
    }

    /**
     * Create new topic
     *
     * @return Json
     **/
    public function store()
    {
        $validatedData = request()->validate([
            'title' => 'required|string|max:255'
        ]);

        $validatedData['user_id'] = request()->user()->id;

        $topic = Topic::create($validatedData);

        $topic->votes()->attach(request()->user()->id);

        return [
            'topics' => Topic::getList(),
        ];
    }

    /**
     * Add new vote to the topic
     *
     * @return Json
     **/
    public function storeTopicVote()
    {
        $validatedData = request()->validate([
            'topic_id' => 'required|numeric|exists:topics,id'
        ]);

        $topic = Topic::find(request('topic_id'));

        $topic->votes()->attach(request()->user()->id);

        return [
            'topics' => Topic::getList(),
        ];
    }
}
