<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ttf\Algorithm;

class InsuranceController extends Controller
{
    function index(Request $request)
    {
        $params = $this->filterRequest($request);
        $algo = new Algorithm($params);
        $result = $algo->compute();
        return response()->json($result);
    }

    /**
     * Make sure only the allowable variables are passed.
     *
     * @param $request
     * @return array
     */
    private function filterRequest($request)
    {
        $data = [
            'a' => $request->get('a'),
            'b' => $request->get('b'),
            'c' => $request->get('c'),
            'd' => $request->get('d'),
            'e' => $request->get('e'),
            'f' => $request->get('f'),
        ];
        if ($hold = $request->get('specialized')) {
            $data['specialized'] = $hold;
        }
        return $data;
    }
}
