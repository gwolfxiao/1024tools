<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Typo extends Model
{
    public $table = 'typos';

    protected function getRoute($typo)
    {
        $route = null;
        if ($typo) {
            $route = static::where('typo', $typo)->pluck('route');
        }

        return $route;
    }
}
