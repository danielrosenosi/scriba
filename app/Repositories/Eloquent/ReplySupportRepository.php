<?php

namespace App\Repositories\Eloquent;

use App\DTO\Replies\StoreReplyDTO;
use App\Models\ReplySupport;
use App\Repositories\Contracts\ReplyRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use stdClass;

class ReplySupportRepository implements ReplyRepositoryInterface
{
    public function __construct(protected ReplySupport $model) {}

    public function getAllBySupport(string $supportId): array
    {
        $replies = $this->model->where('support_id', $supportId)->with([
            'user' => fn ($query) => $query->select('id', 'name', 'email'),
        ])->get();

        return $replies->toArray();
    }

    public function store(StoreReplyDTO $dto): stdClass
    {
        $reply = $this->model->create([
            'content' => $dto->content,
            'support_id' => $dto->supportId,
        ]);

        return (object) $reply->toArray();
    }

    public function destroy(string $id, string $replyId): RedirectResponse|JsonResponse|bool
    {
        $reply = $this->model->find($replyId);

        if ($reply->support_id !== auth()->user()->id) {
            return response()->json(['message' => 'Você não tem permissão para excluir essa resposta!'], 403);
        }

        return $reply->delete();
    }
}