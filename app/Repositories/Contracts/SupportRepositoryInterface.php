<?php

namespace App\Repositories\Contracts;

use App\DTO\Supports\StoreSupportDTO;
use App\DTO\Supports\UpdateSupportDTO;
use stdClass;

interface SupportRepositoryInterface
{
    public function paginate(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface;

    public function index(string $filter = null): array;

    public function show(string $id): ?stdClass;

    public function store(StoreSupportDTO $dto): stdClass;

    public function update(UpdateSupportDTO $dto): ?stdClass;

    public function delete(string $id): void;
}
