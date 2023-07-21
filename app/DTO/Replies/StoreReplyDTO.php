<?php

namespace App\DTO\Replies;

class StoreReplyDTO
{
    public function __construct(public string $content, public string $supportId) {}

    public static function makeFromRequest(object $request): self
    {
        return new self($request->support_id, $request->content);
    }
}