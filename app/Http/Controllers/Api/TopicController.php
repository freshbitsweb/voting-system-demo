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
        $topics = Topic::withCount('votes')->get();

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
            'topics' => Topic::withCount('votes')->find($topic->id),
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

        $topic = Topic::withCount('votes')->find(request('topic_id'));

        $topic->votes()->attach(request()->user()->id);

        return [
            'topics' => Topic::withCount('votes')->find(request('topic_id')),
        ];
    }
}
