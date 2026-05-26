<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Announcement extends Model
{
    protected $fillable = [
        'title',
        'message',
        'tenant_id',
    ];

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(User::class, 'tenant_id');
    }

    public function scopeVisibleToTenant($query, int $tenantId)
    {
        return $query->whereNull('tenant_id')
            ->orWhere('tenant_id', $tenantId);
    }
}