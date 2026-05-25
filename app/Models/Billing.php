<?php

// app/Models/Billing.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    protected $fillable = [
        'tenant_id',
        'amount',
        'due_date',
        'month',
        'status',
        'remarks',
        'gcash_receipt_path',
        'gcash_reference_number',
        'receipt_uploaded_at',
        'sms_reminder_sent_at',
    ];
    protected $casts = [
        'due_date' => 'date',
        'receipt_uploaded_at' => 'datetime',
        'sms_reminder_sent_at' => 'datetime',
    ];
    public function tenant()
    {
        return $this->belongsTo(User::class, 'tenant_id');
    }
}