<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentSetting extends Model
{
    protected $fillable = [
        'gcash_number',
        'gcash_account_name',
        'payment_instructions',
    ];

    public static function current(): self
    {
        return self::firstOrCreate(
            ['id' => 1],
            [
                'gcash_number' => '09XXXXXXXXX',
                'gcash_account_name' => 'GCash Account Name',
                'payment_instructions' => 'Pay your rent using the GCash details below, then upload your receipt.',
            ]
        );
    }
}