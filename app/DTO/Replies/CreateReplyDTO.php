<?php

namespace App\DTO\Replies;

class CreateReplyDTO
{
    public function __construct(public string $body, public string $supportId) {}
}