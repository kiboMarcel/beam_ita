<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeDetail extends Model
{
    public function fee_category(){
        return $this->belongsTo(FeeCategory::class, 'feeCategory_id', 'id');
    }
}
