<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSupportRequest;
use App\Http\Requests\UpdateSupportRequest;
use App\Models\Support;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index(Support $support)
    {
        $supports = $support->all();

        return view('admin.supports.index', compact('supports'));
    }

    public function store(StoreSupportRequest $request, Support $support)
    {
        $data = $request->validated();
        $data['status'] = 'a';

        $support->create($data);

        return redirect()->route('supports.index');
    }

    public function update(UpdateSupportRequest $request, Support $support, int $id)
    {
        if (!$support = $support->find($id)) {
            return back();
        }

        $support->update($request->validated());

        return redirect()->route('supports.index');
    }

    public function destroy(string|int $id, Support $support)
    {
        if (!$support = $support->find($id)) {
            return back();
        }

        $support->delete();

        return redirect()->route('supports.index');
    }

    public function show(int $id)
    {
        if (!$support = Support::find($id)) {
            return back();
        }

        return view('admin.supports.show', compact('support'));
    }

    public function edit(int $id)
    {
        if (!$support = Support::find($id)) {
            return back();
        }

        return view('admin.supports.edit', compact('support'));
    }

    public function create()
    {
        return view('admin.supports.create');
    }
}