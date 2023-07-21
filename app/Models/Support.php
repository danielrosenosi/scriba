<?php

namespace App\Models;

use App\Enums\SupportStatusEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'subject',
        'status',
        'body',
    ];

    public function status(): Attribute
    {
        return Attribute::make(set: fn (SupportStatusEnum $status) => $status->name);
    }
}
