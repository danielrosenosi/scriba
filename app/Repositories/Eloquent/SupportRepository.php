<?php

namespace App\Repositories\Eloquent;

use App\DTO\Supports\StoreSupportDTO;
use App\DTO\Supports\UpdateSupportDTO;
use App\Enums\SupportStatusEnum;
use App\Models\Support;
use App\Repositories\Contracts\PaginationInterface;
use App\Repositories\Contracts\SupportRepositoryInterface;
use App\Repositories\PaginationPresenter;
use Illuminate\Support\Facades\Gate;
use stdClass;

class SupportRepository implements SupportRepositoryInterface
{
    public function __construct(protected Support $model)
    {
    }

    public function paginate(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface
    {
        $supports = $this->model->when($filter, function ($query) use ($filter) {
            $query->where('subject', $filter);
            $query->orWhere('body', 'like', "%{$filter}%");
        })->paginate($totalPerPage, ['*'], 'page', $page);

        $supports->getCollection()->transform(function ($support) {
            $support->load([
                'replies' => function ($query) {
                    $query->select('id', 'support_id', 'user_id',)
                        ->with(['user' => fn ($query) => $query->select('id', 'name')])
                        ->orderBy('created_at', 'desc')
                        ->limit(4);
                },
            ]);

            return $support;
        });

        return new PaginationPresenter($supports);
    }

    public function index(string $filter = null): array
    {
        $supports = $this->model->when($filter, function ($query) use ($filter) {
            $query->where('subject', $filter);
            $query->orWhere('body', 'like', "%{$filter}%");
        })
            ->with('user')
            ->get()
            ->toArray();

        return $supports;
    }

    public function show(string $id): ?stdClass
    {
        $support = $this->model->find($id);

        if (! $support) {
            return null;
        }

        $support->load('user');

        return (object) $support->toArray();
    }

    public function store(StoreSupportDTO $dto): stdClass
    {
        $support = $this->model->create((array) $dto);

        return (object) $support->toArray();
    }

    public function update(UpdateSupportDTO $dto): ?stdClass
    {
        if (! $support = $this->model->find($dto->id)) {
            return null;
        }

        if (! Gate::allows('owner', $support->user_id)) {
            abort(403, 'Not Authorized');
        }

        $support->update((array) $dto);

        return (object) $support->toArray();
    }

    public function delete(string $id): void
    {
        $support = $this->model->findOrFail($id);

        if (! Gate::allows('owner', $support->user_id)) {
            abort(403, 'Not Authorized');
        }

        $support->delete();
    }

    public function updateStatus(string $id, SupportStatusEnum $status): void
    {
        $this->model->where('id', $id)->update(['status' => $status->name]);
    }
}
