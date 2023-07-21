<?php

use App\Enums\SupportStatusEnum;

if (! function_exists('getStatusSupport')) {
    function getStatusSupport(string $status): string
    {
        return SupportStatusEnum::getDescription($status);
    }

    function getTwoInitials(string $name): string
    {
        $initials = preg_filter('/[^A-Z]/', '', $name);

        return substr($initials, 0, 2);
    }
}
