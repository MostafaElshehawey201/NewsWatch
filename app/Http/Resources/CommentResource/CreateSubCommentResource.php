<?php

namespace App\Http\Resources\CommentResource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CreateSubCommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'success' => true,
            'data' => [
                'id' => $this->id,
                'parent_comment_id' => $this->parent_comment_id,
                'user_id' => $this->user_id,
                'content' => $this->content,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            "errors" => null,
        ];
    }
}
