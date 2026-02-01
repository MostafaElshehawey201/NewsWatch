<?php

namespace App\Http\Resources\CommentResource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeleteSubCommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "success" => true,
            "data" => __('validation.subComment.delete.success'),            
        ];
    }
}
