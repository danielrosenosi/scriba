<?php

namespace App\Http\Controllers\Admin;

use App\DTO\Supports\StoreSupportDTO;
use App\DTO\Supports\UpdateSupportDTO;
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
        $supports = $this->service->paginate(
            page: $request->get('page', 1),
            totalPerPage: $request->get('per_page', 1),
            filter: $request->filter
        );

        $filters = ['filter' => $request->get('filter', '')];

        return view('admin.supports.index', compact(['supports', 'filters']));
    }

    public function store(StoreSupportRequest $request)
    {
        $this->service->store(StoreSupportDTO::makeFromRequest($request));

        return redirect()->route('supports.index');
    }

    public function update(UpdateSupportRequest $request, Support $support, int $id)
    {
        $support = $this->service->update(UpdateSupportDTO::makeFromRequest($request, $id));

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