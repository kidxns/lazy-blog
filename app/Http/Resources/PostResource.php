<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'category' => new CategoryResource($this->category),
            'author' => new UserResource($this->author),
            'status' => $this->status,
            'comments_count' => count($this->comments),
            'view_count' => $this->view_count,
            'thumbnail' => $this->getthumb->getFirstMediaUrl('blog', 'thumb'),
            'thumb_id' => $this->thumb_id,
            'posted_at' => $this->posted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

        ];
    }
}
