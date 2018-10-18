<?php

namespace App\Http\Resources;

use App\Topic;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TopicCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->topics->map(function (Topic $topic) {
            return (new TopicResource($topic));
        });
    }
}
