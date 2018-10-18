<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TopicResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'topic_id' => $this->id,
            'title' => $this->title,
            'votes' => VoteResource::collection($this->whenLoaded('votes')),
            'user' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
