<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OutletPaynow extends Model
{
    protected $fillable=['outlet_id','integrationId','integrationKey','status'];
    protected $primaryKey='outlet_id';
}
