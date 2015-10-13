<?php

namespace App\Http\Controllers;

use View;
use Input;
use Rhumsaa\Uuid\Uuid;
use App\Support\ApiResponse;
use App\Exceptions\ToolsException;

class ExtraController extends Controller
{
    public function getRandom()
    {
        return View::make('extra.random');
    }

    public function getUuid()
    {
        return View::make('extra.uuid');
    }

    public function postUuid()
    {
        $num = Input::get('num');
        try {
            $this->validate(compact('num'), [
                'num' => 'required|integer|between:1,10',
            ]);
            $uuids = [];
            do {
                array_push($uuids, Uuid::uuid4()->toString());
                --$num;
            } while ($num > 0);

            return ApiResponse::success($uuids);
        } catch (ToolsException $e) {
            return ApiResponse::error($e->getMessage());
        }
    }
}
