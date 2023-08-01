<?php

namespace App\Http\Controllers\Api;

use App\DTO\Replies\StoreReplyDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReplySupportRequest;
use App\Http\Resources\ReplySupportResource;
use App\Services\ReplySupportService;
use App\Services\SupportService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

class ReplySupportApiController extends Controller
{
    public function __construct(
        protected SupportService $supportService,
        protected ReplySupportService $replyService
    ) {
    }

    public function showBySupportId(string $id): ResourceCollection|JsonResponse
    {
        if (! $this->supportService->show($id)) {
            return response()->json(['message' => 'Support not found'], Response::HTTP_NOT_FOUND);
        }

        $replies = $this->replyService->getAllBySupport($id);

        return ReplySupportResource::collection($replies);
    }

    public function store(StoreReplySupportRequest $request): JsonResponse
    {
        $reply = $this->replyService->store(StoreReplyDTO::makeFromRequest($request));

        return (new ReplySupportResource($reply))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function destroy(string $replyId): JsonResponse
    {
        $this->replyService->delete($replyId);

        return response()->json(Response::HTTP_NO_CONTENT);
    }
}
