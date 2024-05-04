<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'note', 'price', 'active_date', 'property_id',
        'client_id', 'earn_price', 'status',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'contract_id', 'id');
    }

    public function client()
    {
        return $this->hasOne(Client::class, 'id', 'client_id')
            ->select(['id', 'firstname', 'lastname', 'phone']);
    }

    public function property()
    {
        return $this->hasOne(Property::class, 'id', 'property_id')
            ->select(['id', 'name', 'price']);
    }
}
