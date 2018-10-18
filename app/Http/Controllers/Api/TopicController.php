<?php

namespace App\Http\Controllers\Api;

use App\Topic;
use App\Http\Resources\TopicResource;

class TopicController extends ApiController
{
    /**
     * Returns the list of the topics
     *
     * @return Json
     **/
    public function index()
    {
        $topics = Topic::with(['votes', 'user:id,name'])->get();

        return [
            'topics' => TopicResource::collection($topics),
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
            'topic' => new TopicResource($topic->load('votes', 'user:id,name')),
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

        $topic = Topic::with('user:id,name')->find(request('topic_id'));

        $topic->votes()->attach(request()->user()->id);

        return [
            'topic' => new TopicResource($topic->load('votes')),
        ];
    }
}
