<?php

// app/Models/MaintenanceRequest.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceRequest extends Model
{
    protected $fillable = [
        'tenant_id',
        'title',
        'description',
        'status'
    ];

    public function tenant()
    {
        return $this->belongsTo(User::class, 'tenant_id');
    }
}