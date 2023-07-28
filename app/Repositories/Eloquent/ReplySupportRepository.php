<?php

namespace App\Repositories\Eloquent;

use App\DTO\Replies\StoreReplyDTO;
use App\Models\ReplySupport;
use App\Repositories\Contracts\ReplyRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use stdClass;

class ReplySupportRepository implements ReplyRepositoryInterface
{
    public function __construct(protected ReplySupport $model)
    {
    }

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

        $reply->load([
            'user' => fn ($query) => $query->select('id', 'name', 'email'),
            'support' => fn ($query) => $query->select('id', 'subject', 'body', 'user_id'),
            'support.user' => fn ($query) => $query->select('id', 'name', 'email'),
        ]);

        return (object) $reply->toArray();
    }

    public function delete(string $replyId): RedirectResponse|JsonResponse|bool
    {
        $reply = $this->model->find($replyId);

        if (! Gate::allows('owner', $reply->user_id)) {
            abort(403, 'Not Authorized');
        }

        if ($reply->user_id !== auth()->user()->id) {
            return response()->json(['message' => 'Você não tem permissão para excluir essa resposta!'], 403);
        }

        return $reply->delete();
    }
}
