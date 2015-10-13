<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class Typo extends Model
{
    public $table = 'typo';

    protected function getRoute($typo)
    {
        $route = null;
        if ($typo) {
            $route = static::where('typo', $typo)->pluck('route');
        }

        return $route;
    }
}
