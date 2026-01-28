<?php

namespace App\Http\Resources\CommentResource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EditSubCommentResource extends JsonResource
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
                'content' => $this->content,
                'parent_comment_id' => $this->parent_comment_id,
                'created_at' => $this->created_at->toDateTimeString(),
                'user' => [
                    'id' => $this->user->id,
                    'name' => $this->user->name,
                ]
            ],
            'errors' => null,
        ];
    }
}
