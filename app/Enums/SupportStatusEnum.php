<?php

namespace App\Enums;

enum SupportStatusEnum: string
{
    case A = "Aberto";
    case C = "Fechado";
    case P = "Pendente";

    public static function getDescription(string $value)
    {
        foreach(self::cases() as $status) {
            if ($status->name === $value) {
                return $status->value;
            }
        }

        throw new \ValueError("Invalid status");
    }
}