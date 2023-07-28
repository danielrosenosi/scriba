<?php

namespace App\Repositories\Contracts;

use App\DTO\Replies\StoreReplyDTO;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use stdClass;

interface ReplyRepositoryInterface
{
    public function getAllBySupport(string $supportId): array;

    public function store(StoreReplyDTO $dto): stdClass;

    public function delete(string $replyId): RedirectResponse|JsonResponse|bool;
}
