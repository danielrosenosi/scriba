<?php

namespace App\Services;

use App\DTO\Replies\CreateReplyDTO;
use stdClass;

class ReplySupportService
{
    public function getAllBySupport(string $supportId): array
    {
        return [];
    }

    public function store(CreateReplyDTO $dto): stdClass
    {
        throw new \Exception('Not implemented');
    }
}