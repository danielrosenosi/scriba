<?php

namespace App\Repositories\Contracts;

use App\DTO\Replies\CreateReplyDTO;
use stdClass;

interface ReplyRepositoryInterface
{
    public function getAllBySupport(string $supportId): array;

    public function store(CreateReplyDTO $dto): stdClass;
}