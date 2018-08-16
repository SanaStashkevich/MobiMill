<?php

namespace App\Http\Controllers;

use App\Http\Resources\Formatter;
use App\Hybrids;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HybridController extends Controller
{
    public function index(Request $request)
    {
        $faoUnits = explode(',', $request->input('FAOUnits'));
        $result = (!empty($faoUnits) && count($faoUnits) >= 2)
            ? DB::table('CornHybrids')
                ->select('Cultures.Name as CulturaName', 'Hybrids.*')
                ->join('Hybrids', 'Hybrids.id', '=', 'CornHybrids.HybridId')
                ->join('Cultures', 'Cultures.id', '=', 'Hybrids.CulturesId')
                ->whereBetween('FAOUnits', [intval($faoUnits[0]), intval($faoUnits[1])])
                ->get()
            : Hybrids::all();
        return new Formatter($result);
    }
}
