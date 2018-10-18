<?php

namespace App\Http\Controllers\Api;

use App\Topic;
use App\Http\Controllers\Controller;
use App\Http\Resources\TopicResource;

class TopicController extends Controller
{
    /**
     * Returns the list of the topics
     *
     * @return json
     **/
    public function index()
    {
        $topics = Topic::with(['votes', 'user:id,name'])->get();

        return apiResponse("List of Topics", [
            'topics' => TopicResource::collection($topics)
        ]);
    }

    /**
     * Create new topic
     *
     * @return json
     **/
    public function store()
    {
        $validatedData = request()->validate([
            'title' => 'required|string|max:255|unique:topics,title'
        ]);

        $validatedData['user_id'] = request()->user()->id;

        $topic = Topic::create($validatedData);

        $topic->votes()->attach(request()->user()->id);

        return apiResponse("Topic added successfully.", [
            'topic' => new TopicResource($topic->load('votes', 'user:id,name'))
        ]);
    }

    /**
     * Add new vote to the topic
     *
     * @return json
     **/
    public function voteForTopic()
    {
        $validatedData = request()->validate([
            'topic_id' => 'required|numeric|exists:topics,id'
        ]);

        $topic = Topic::with('user:id,name')->find(request('topic_id'));

        $topic->votes()->attach(request()->user()->id);

        return apiResponse("Voted for the topic successfully.", [
            'topic' => new TopicResource($topic->load('votes'))
        ]);
    }
}
