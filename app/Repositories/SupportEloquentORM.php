<?php

namespace App\Repositories;

use App\DTO\StoreSupportDTO;
use App\DTO\UpdateSupportDTO;
use App\Models\Support;
use App\Repositories\SupportRepositoryInterface;
use stdClass;

class SupportEloquentORM implements SupportRepositoryInterface
{
    public function __construct(protected Support $model) {}

    public function paginate(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface
    {
        $supports = $this->model->when($filter, function ($query) use ($filter) {
            $query->where('subject', $filter);
            $query->orWhere('body', 'like', "%{$filter}%");
        })
        ->paginate($totalPerPage, ['*'], 'page', $page)
        ->toArray();

        return $supports;
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

    public function show(int $id): stdClass|null
    {
        $support = $this->model->find($id);

        if (!$support) {
            return null;
        }

        return (object) $support->toArray();
    }

    public function store(StoreSupportDTO $dto): stdClass
    {
        $support = $this->model->create((array) $dto);

        return (object) $support->toArray();
    }

    public function update(UpdateSupportDTO $dto): stdClass|null
    {
        if (!$support = $this->model->find($dto->id)) {
            return null;
        }

        $support->update((array) $dto);

        return (object) $support->toArray();
    }

    public function delete(int $id): void
    {
        $this->model->findOrFail($id)->delete();
    }
}