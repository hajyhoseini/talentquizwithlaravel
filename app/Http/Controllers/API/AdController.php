<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use Illuminate\Http\Request;

class AdController extends Controller
{
    public function index(Request $request)
    {
        $query = Ad::query();

        if ($request->has('operator')) {
            $query->where('operator', $request->operator);
        }

        return response()->json([
            'status' => 'success',
            'data' => $query->get()
        ]);
    }
}
