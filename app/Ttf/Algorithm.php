<?php

namespace Ttf;


class Algorithm
{
    protected $params;

    protected $algorithms = [
        AlgorithmBaseMappingS::class,
        AlgorithmBaseMappingR::class,
        AlgorithmBaseMappingT::class,
        AlgorithmSpecializedMappingS::class,
        AlgorithmSpecializedMappingR::class,
        AlgorithmSpecializedMappingT::class,
    ];

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
        if (! $this->isValidParams()) {
            return $this->invalid();
        }

        if (! isset($this->params['specialized'])) {
            $this->params['specialized'] = false;
        }

        foreach ($this->algorithms as $algorithm) {
            if ($result = $algorithm::tryThis($algorithm, $this->params)) {
                return $result;
            }
        }

        return $this->invalid();
    }

    private function invalid()
    {
        return '*** INVALID ***';
    }

    /**
     * Make sure that input parameters are the expected types.
     * @param $params
     * @return bool
     */
    private function isValidParams()
    {
        foreach ($this->params as $key => $value) {
            if (in_array($key, ['a', 'b', 'c', 'specialized'])) {
                $isValid = is_bool($value) || $value === 1 || $value === 0;
            } else {
                $isValid = is_numeric($value);
            }
            if (!$isValid) return false;
        }

        return true;
    }
}