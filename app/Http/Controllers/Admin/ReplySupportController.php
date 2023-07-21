<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ReplySupportService;
use App\Services\SupportService;
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
}