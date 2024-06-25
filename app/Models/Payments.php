<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payments extends Model
{
    use HasFactory;
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $table = 'payments'; // Specify the table name if different from model name convention

    protected $fillable = [
        'payment_id',
        'user_id',
        'amount',
        'currency',
        'status',
        'response'
    ];
}
