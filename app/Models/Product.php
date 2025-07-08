<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'guid',
        'name',
        'stock',
        'active',
        'createdDate',
        'createdBy',
        'modifiedDate',
        'modifiedBy'
    ];
    protected $primaryKey= 'id';
}
