<?php

namespace Ttf;


abstract class AlgorithmBase
{
    public $params;

    abstract protected function isApplicable();
    abstract protected function X();
    abstract protected function Y();

    public static function tryThis($klass, $params)
    {
        $algorithm = new $klass($params);
        if (!$algorithm->isApplicable()) {
            return false;
        }
        return [
            'X' => $algorithm->X(),
            'Y' => $algorithm->Y()
        ];
    }

    public function __construct($params)
    {
        $this->params = $params;
    }

}