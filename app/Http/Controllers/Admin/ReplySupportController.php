<?php

namespace App\Http\Controllers\Admin;

use App\DTO\Replies\StoreReplyDTO;
use App\Http\Controllers\Controller;
use App\Services\ReplySupportService;
use App\Services\SupportService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReplySupportController extends Controller
{
    public function __construct(
        protected SupportService $supportService,
        protected ReplySupportService $replyService
    ) {}

    public function index(string $id)
    {
        if (! $support = $this->supportService->show($id)) {
            return back();
        }

        $replies = $this->replyService->getAllBySupport($id);

        return view('admin.supports.replies.index', compact('support', 'replies'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->replyService->store(StoreReplyDTO::makeFromRequest($request));

        return redirect()->route('replies.index', $request->support_id)->with('message', 'Resposta cadastrada com sucesso!');
    }

    public function destroy(string $replyId): RedirectResponse|JsonResponse|bool
    {
        $this->replyService->delete($replyId);

        return back()->with('message', 'Resposta excluída com sucesso!');
    }
}