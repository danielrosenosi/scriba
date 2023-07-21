<?php

namespace App\DTO\Supports;

use App\Enums\SupportStatusEnum;
use App\Http\Requests\UpdateSupportRequest;

class UpdateSupportDTO
{
    public function __construct(
        public string $id,
        public string $subject,
        public SupportStatusEnum $status,
        public string $body,
    ) {
    }

    public static function makeFromRequest(UpdateSupportRequest $request, string $id): self
    {
        return new self($id, $request->subject, SupportStatusEnum::A, $request->body);
    }
}
