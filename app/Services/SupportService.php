<?php

namespace App\Services;

use App\DTO\StoreSupportDTO;
use App\DTO\UpdateSupportDTO;
use App\Repositories\SupportRepositoryInterface;
use stdClass;

class SupportService
{
    public function __construct(protected SupportRepositoryInterface $repository) {}

    public function index(string $filter = null): array
    {
        return $this->repository->index($filter);
    }

    public function show(int $id): stdClass|null
    {
        return $this->repository->show($id);
    }

    public function store(StoreSupportDTO $dto): stdClass
    {
        return $this->repository->store($dto);
    }

    public function update(UpdateSupportDTO $dto): stdClass|null
    {
        return $this->repository->update($dto);
    }

    public function delete(int $id): void
    {
        $this->repository->delete($id);
    }
}