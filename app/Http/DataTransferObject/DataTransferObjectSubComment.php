<?php
    namespace App\Http\DataTransferObject;


    final readonly class DataTransferObjectSubComment{
        public string $content;
        public int $parent_comment_id;
        public int $user_id;

        public function __construct(array $data)
        {
            $this->content = $data['content'];
            $this->parent_comment_id = $data['parent_comment_id'];
            $this->user_id = $data['user_id'];
        }
    }
?>