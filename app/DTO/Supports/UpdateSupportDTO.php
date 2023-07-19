<?php

namespace App\DTO\Supports;

use App\Http\Requests\UpdateSupportRequest;

class UpdateSupportDTO
{
    public function __construct(
        public int $id,
        public string $subject,
        public string $status,
        public string $body,
    ) {}

    public static function makeFromRequest(UpdateSupportRequest $request, int $id): self
    {
        return new self($id, $request->subject, 'a', $request->body);
    }
}