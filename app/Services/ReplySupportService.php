<?php

namespace App\Services;

use App\DTO\Replies\StoreReplyDTO;
use App\Repositories\Contracts\ReplyRepositoryInterface;
use stdClass;

class ReplySupportService
{
    public function __construct(protected ReplyRepositoryInterface $repository) {}

    public function getAllBySupport(string $supportId): array
    {
        return $this->repository->getAllBySupport($supportId);
    }

    public function store(StoreReplyDTO $dto): stdClass
    {
        return $this->repository->store($dto);
    }
}