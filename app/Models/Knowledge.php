<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Admin; 
use App\Models\Status;
use App\Models\Scope;

class Knowledge extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'created_by'); 
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function scope(): BelongsTo
    {
        return $this->belongsTo(Scope::class, 'scope_id');
    }
}
