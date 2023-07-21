<?php

namespace App\DTO\Supports;

use App\Enums\SupportStatusEnum;
use App\Http\Requests\StoreSupportRequest;

class StoreSupportDTO
{
    public function __construct(
        public string $subject,
        public SupportStatusEnum $status,
        public string $body,
    ) {
    }

    public static function makeFromRequest(StoreSupportRequest $request): self
    {
        return new self($request->subject, SupportStatusEnum::A, $request->body);
    }
}
