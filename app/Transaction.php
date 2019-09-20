<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['payment_model', 'payment_action', 'payment_record', 'payment_column', 'amount', 'value'];
}
