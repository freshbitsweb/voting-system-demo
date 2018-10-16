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
}
