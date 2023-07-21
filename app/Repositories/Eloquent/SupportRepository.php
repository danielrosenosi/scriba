<?php

namespace App\Repositories\Eloquent;

use App\DTO\Supports\StoreSupportDTO;
use App\DTO\Supports\UpdateSupportDTO;
use App\Models\Support;
use App\Repositories\Contracts\PaginationInterface;
use App\Repositories\Contracts\SupportRepositoryInterface;
use App\Repositories\PaginationPresenter;
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
        })
            ->paginate($totalPerPage, ['*'], 'page', $page);

        return new PaginationPresenter($supports);
    }

    public function index(string $filter = null): array
    {
        $supports = $this->model->when($filter, function ($query) use ($filter) {
            $query->where('subject', $filter);
            $query->orWhere('body', 'like', "%{$filter}%");
        })
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

        $support->update((array) $dto);

        return (object) $support->toArray();
    }

    public function delete(string $id): void
    {
        $this->model->findOrFail($id)->delete();
    }
}