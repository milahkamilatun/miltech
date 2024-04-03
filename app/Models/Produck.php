<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produck extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_name',
        'qty',
        'selling_price',
        'buyying_price',
        'product_type_id',
        'product_status',
    ];

    public function product_type(){
        return $this->belongsTo(ProduckType::class, 'product_type_id');
    }
}
