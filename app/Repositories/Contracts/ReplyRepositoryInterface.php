<?php

namespace App\Repositories\Contracts;

use App\DTO\Replies\StoreReplyDTO;
use stdClass;

interface ReplyRepositoryInterface
{
    public function getAllBySupport(string $supportId): array;

    public function store(StoreReplyDTO $dto): stdClass;
}