<?php

namespace Ttf;


class Algorithm
{
    protected $params;

    public function __construct($params)
    {
        $this->params = $params;
    }

    /**
     * Outputs:
     *    X: enum[S,R,T]
     *    Y: real/float/decimal
     * @return array|string
     */
    public function compute()
    {
        if ($this->isValidParams()) {
            if (isset($this->params['specialized']) && $this->params['specialized']) {
                if ($this->isSpecializedMapping_S()) return $this->computeSpecializedMapping_S();
                if ($this->isSpecializedMapping_R()) return $this->computeSpecializedMapping_R();
                if ($this->isSpecializedMapping_T()) return $this->computeSpecializedMapping_T();
            } else {
                if ($this->isBaseMapping_S()) return $this->computeBaseMapping_S();
                if ($this->isBaseMapping_R()) return $this->computeBaseMapping_R();
                if ($this->isBaseMapping_T()) return $this->computeBaseMapping_T();
            }
        }

        return $this->invalid();
    }

    /**
     * Base Conditions
     * @return bool
     */
    private function isBaseMapping_S() {
        //    A && B && !C => X = S
        return $this->params['a'] && $this->params['b'] && !$this->params['c'];
    }

    private function isBaseMapping_R() {
        //    A && B && C => X = R
        return $this->params['a'] && $this->params['b'] && $this->params['c'];
    }

    private function isBaseMapping_T() {
        //    !A && B && C => X = T
        return !$this->params['a'] && $this->params['b'] && $this->params['c'];
    }

    /**
     * Specialized Conditions
     * @return bool
     */

    //    Specialized 2
    private function isSpecializedMapping_S() {
        //    A && !B && C => X = S
        return $this->params['a'] && !$this->params['b'] && $this->params['c'];
    }

    //    Specialized 1
    private function isSpecializedMapping_R() {
        return $this->isBaseMapping_R();
    }

    //    Specialized 2
    private function isSpecializedMapping_T() {
        //    A && B && !C => X = T
        return $this->params['a'] && $this->params['b'] && !$this->params['c'];
    }

    /**
     * Base Computations
     * @return array
     */
    private function computeBaseMapping_S()
    {
        return [
            'X' => 'S',
            // Y = D + (D * E / 100)
            'Y' => $this->params['d']
                + ($this->params['d'] * $this->params['e'] / 100)
        ];
    }

    private function computeBaseMapping_R()
    {
        return [
            'X' => 'R',
            // Y = D + (D * (E - F) / 100)
            'Y' => $this->params['d']
                + ($this->params['d'] *
                    ($this->params['e'] - $this->params['f'])
                    / 100)
        ];
    }

    private function computeBaseMapping_T()
    {
        return [
            'X' => 'T',
            // Y = D - (D * F / 100)
            'Y' => $this->params['d']
                - ($this->params['d'] * $this->params['f'] / 100)
        ];
    }

    /**
     * Specialized Computations
     * @return array
     */
    private function computeSpecializedMapping_S()
    {
        return [
            'X' => 'S',
            // Y = F + D + (D * E / 100)
            'Y' => $this->params['f'] + $this->params['d']
                + ($this->params['d'] * $this->params['e'] / 100)
        ];
    }

    //    Specialized 1
    private function computeSpecializedMapping_R()
    {
        return [
            'X' => 'R',
            // Y = 2D + (D * E / 100)
            'Y' => 2 * $this->params['d']
                + ($this->params['d'] * $this->params['e'] / 100)
        ];
    }

    private function computeSpecializedMapping_T()
    {
        return $this->computeBaseMapping_T();
    }

    private function invalid()
    {
        return '*** INVALID ***';
    }

    /**
     * Make sure that
     * @param $params
     * @return bool
     */
    private function isValidParams()
    {
        $isValid = false;

        foreach ($this->params as $key => $value) {
            if (in_array($key, ['a', 'b', 'c', 'specialized'])) {
                /**
                 * Must be boolean.
                 */
                if ($value === 1) {
                    $value = true;
                } elseif ($value === 0) {
                    $value = false;
                }
                $isValid = is_bool($value);

            } else {
                /**
                 * Must be numeric.
                 */
                $isValid = is_numeric($value);
            }

            if (!$isValid) return false;
        }

        return true;
    }
}