<?php

namespace App\Http\Controllers\Admin;

use App\DTO\StoreSupportDTO;
use App\DTO\UpdateSupportDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSupportRequest;
use App\Http\Requests\UpdateSupportRequest;
use App\Models\Support;
use App\Services\SupportService;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function __construct(protected SupportService $service) {}

    public function index(Request $request)
    {
        $supports = $this->service->index($request->filter);

        return view('admin.supports.index', compact('supports'));
    }

    public function store(StoreSupportRequest $request)
    {
        $this->service->store(StoreSupportDTO::makeFromRequest($request->validated()));

        return redirect()->route('supports.index');
    }

    public function update(UpdateSupportRequest $request, Support $support, int $id)
    {
        $support = $this->service->update(UpdateSupportDTO::makeFromRequest($request->validated(), $id));

        if (!$support) {
            return back();
        }

        return redirect()->route('supports.index');
    }

    public function destroy(int $id)
    {
        $this->service->delete($id);

        return redirect()->route('supports.index');
    }

    public function show(int $id)
    {
        if (!$support = $this->service->show($id)) {
            return back();
        }

        return view('admin.supports.show', compact('support'));
    }

    public function edit(int $id)
    {
        if (!$support = $this->service->show($id)) {
            return back();
        }

        return view('admin.supports.edit', compact('support'));
    }

    public function create()
    {
        return view('admin.supports.create');
    }
}