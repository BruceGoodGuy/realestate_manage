<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'message',
        'from',
        'to',
        'amount',
        'status',
        'approve_date',
        'contract_id',
    ];

    public function client() {
        return $this->hasOne(Client::class, 'id', 'to');
    }
}
