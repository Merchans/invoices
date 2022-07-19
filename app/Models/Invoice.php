<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    
    protected $fillable = ['receiver', 'supplier', 'issue_date', 'terms', 'description', 'number', 'price_per_unit'];

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
