<?php

namespace App\Services;

use App\DTO\Replies\StoreReplyDTO;
use App\Events\SupportRepliedEvent;
use App\Repositories\Contracts\ReplyRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use stdClass;

class ReplySupportService
{
    public function __construct(protected ReplyRepositoryInterface $repository)
    {
    }

    public function getAllBySupport(string $supportId): array
    {
        return $this->repository->getAllBySupport($supportId);
    }

    public function store(StoreReplyDTO $dto): stdClass
    {
        $reply = $this->repository->store($dto);

        SupportRepliedEvent::dispatch($reply);

        return $reply;
    }

    public function delete(string $replyId): RedirectResponse|JsonResponse|bool
    {
        return $this->repository->delete($replyId);
    }
}
