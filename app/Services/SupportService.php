<?php

namespace App\Services;

use App\DTO\Supports\StoreSupportDTO;
use App\DTO\Supports\UpdateSupportDTO;
use App\Enums\SupportStatusEnum;
use App\Repositories\Contracts\PaginationInterface;
use App\Repositories\Contracts\SupportRepositoryInterface;
use stdClass;

class SupportService
{
    public function __construct(protected SupportRepositoryInterface $repository)
    {
    }

    public function paginate(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface
    {
        return $this->repository->paginate($page, $totalPerPage, $filter);
    }

    public function index(string $filter = null): array
    {
        return $this->repository->index($filter);
    }

    public function show(string $id): ?stdClass
    {
        return $this->repository->show($id);
    }

    public function store(StoreSupportDTO $dto): stdClass
    {
        return $this->repository->store($dto);
    }

    public function update(UpdateSupportDTO $dto): ?stdClass
    {
        return $this->repository->update($dto);
    }

    public function delete(string $id): void
    {
        $this->repository->delete($id);
    }

    public function updateStatus(string $id, SupportStatusEnum $status): void
    {
        $this->repository->updateStatus($id, $status);
    }
}
