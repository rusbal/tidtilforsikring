<?php

namespace Ttf;


class AlgorithmBaseMappingR extends AlgorithmBase
{
    /**
     * Checks if this algorithm is applicable
     *
     * @return boolean
     */
    public function isApplicable()
    {
        if ($this->params['specialized']) {
            return false;
        }
        return $this->params['a'] && $this->params['b'] && $this->params['c'];
    }

    protected function X()
    {
        return 'R';
    }

    /**
     * Computes the result based on formula
     *
     * @return number real|float|decimal
     */
    protected function Y()
    {
        return $this->params['d']
                + ($this->params['d'] *
                    ($this->params['e'] - $this->params['f'])
                    / 100);
    }
}