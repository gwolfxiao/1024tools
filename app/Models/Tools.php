<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tools extends Model
{
    const STATUS_NO = 0;
    const STATUS_OK = 1;

    public $table = 'tools';

    public function scopeStatusOk($query)
    {
        return $query->where('status', self::STATUS_OK);
    }
}
