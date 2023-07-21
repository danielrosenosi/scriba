<?php

namespace App\Repositories\Eloquent;

use App\DTO\Replies\StoreReplyDTO;
use App\Models\ReplySupport;
use App\Repositories\Contracts\ReplyRepositoryInterface;
use stdClass;

class ReplySupportRepository implements ReplyRepositoryInterface
{
    public function __construct(protected ReplySupport $model) {}

    public function getAllBySupport(string $supportId): array
    {
        $replies = $this->model->where('support_id', $supportId)->get();

        return $replies->toArray();
    }

    public function store(StoreReplyDTO $dto): stdClass
    {
        $reply = $this->model->create([
            'content' => $dto->content,
            'user_id' => auth()->user()->id,
            'support_id' => $dto->supportId,
        ]);

        return (object) $reply->toArray();
    }
}