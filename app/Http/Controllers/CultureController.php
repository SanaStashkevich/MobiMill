<?php

namespace App\Http\Controllers;

use App\Cultures;
use App\Http\Resources\Formatter;
use Illuminate\Http\Request;

class CultureController extends Controller
{
    public function index(Request $request)
    {

        $cultureID = intval($request->input('culturesID'));
        $result = (is_int($cultureID) && $cultureID > 0)
            ? Cultures::find($cultureID)
            : Cultures::all();

        return new Formatter($result);
    }
}
