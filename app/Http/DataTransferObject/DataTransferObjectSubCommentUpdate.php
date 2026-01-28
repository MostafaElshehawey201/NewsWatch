<?php
    namespace App\Http\DataTransferObject;

    final readonly class DataTransferObjectSubCommentUpdate{
        public string $content;
        public int $subComment_id;
        public int $user_id;

        public function __construct(array $data)
        {
            $this->content = $data['content'];
            $this->subComment_id = $data['subComment_id'];
            $this->user_id = $data['user_id'];
        }
    }
?>