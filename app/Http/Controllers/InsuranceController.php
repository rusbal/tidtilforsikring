<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ttf\Algorithm;

class InsuranceController extends Controller
{
    public function index(Request $request)
    {
        $params = $this->filterRequest($request);
        $result = $this->showResult($params);
        $json = response()->json($result);

        if ($request->get('browser-test')) {
            $formula = $this->showFormula($params);
            return view('insurance', compact('json', 'formula', 'params'));
        } else {
            return $json;
        }
    }

    private function showResult($params)
    {
        $algo = new Algorithm($params);
        return $algo->compute();
    }

    private function showFormula($params)
    {
        if (isset($params['specialized']) && ($params['specialized'] === '1' || $params['specialized'] === '0')) {
            if ($params['a'] && !$params['b'] && $params['c']) {
                return "A && !B && C => X = S"
                     . "\n"
                     . "X = S => Y = F + D + (D * E / 100)";
            }
            if ($params['a'] && $params['b'] && $params['c']) {
                return "A && B && C => X = R [ same as base ]"
                    . "\n"
                    . "X = R => Y = 2D + (D * E / 100)";
            }
            if ($params['a'] && $params['b'] && !$params['c']) {
                return "A && B && !C => X = T"
                    . "\n"
                    . "X = T => Y = D - (D * F / 100) [ same as base ]";
            }
        } else {
            if ($params['a'] && $params['b'] && !$params['c']) {
                return "A && B && !C => X = S"
                    . "\n"
                    . "X = S => Y = D + (D * E / 100)";
            }
            if ($params['a'] && $params['b'] && $params['c']) {
                return "A && B && C => X = R"
                    . "\n"
                    . "X = R => Y = D + (D * (E - F) / 100)";
            }
            if (!$params['a'] && $params['b'] && $params['c']) {
                return "!A && B && C => X = T"
                    . "\n"
                    . "X = T => Y = D - (D * F / 100)";
            }
            return '*** INVALID ***';
        }
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
