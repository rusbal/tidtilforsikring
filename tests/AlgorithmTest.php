<?php

use Ttf\Algorithm;

class AlgorithmTest extends TestCase
{
    function testNoInput()
    {
        $input = [];
        $this->json('GET', '/insurance', $input)
            ->seeJson(["*** INVALID ***"]);
    }

    function testIncompleteInputA()
    {
        $input = ['a' => 1, 'b' => 1, 'c' => 0];
        $this->json('GET', '/insurance', $input)
            ->seeJson(["*** INVALID ***"]);
    }

    function testIncompleteInputB()
    {
        $input = ['d' => 10, 'e' => 20, 'f' => 30];
        $this->json('GET', '/insurance', $input)
            ->seeJson(["*** INVALID ***"]);
    }

    function testInvalidInput_B_false()
    {
        $input = ['a' => 1, 'b' => 0, 'c' => 1,
            'd' => 10, 'e' => 20, 'f' => 30];
        $this->json('GET', '/insurance', $input)
            ->seeJson(["*** INVALID ***"]);
    }

    function testInvalidInput_AB_false()
    {
        $input = ['a' => 0, 'b' => 0, 'c' => 1,
            'd' => 10, 'e' => 20, 'f' => 30];
        $this->json('GET', '/insurance', $input)
            ->seeJson(["*** INVALID ***"]);
    }

    function testInvalidInput_ABC_false()
    {
        $input = ['a' => 0, 'b' => 0, 'c' => 0,
                  'd' => 10, 'e' => 20, 'f' => 30];
        $this->json('GET', '/insurance', $input)
            ->seeJson(["*** INVALID ***"]);
    }


    /**
     * A_B_not_C
     */
    function testBaseMappingS()
    {
        $input = [
                'a' => 1, // true
                'b' => 1, // true
                'c' => 0, // false

            'd' => 10, 'e' => 20, 'f' => 30];

        $this->json('GET', '/insurance', $input)
            ->seeJson([
                'X' => 'S',
                'Y' => $input['d'] + ($input['d'] * $input['e'] / 100),
            ]);
    }

    /**
     * A_B_C
     */
    function testBaseMappingR()
    {
        $input = [
                'a' => 1, // true
                'b' => 1, // true
                'c' => 1, // true

            'd' => 10, 'e' => 20, 'f' => 30];

        $this->json('GET', '/insurance', $input)
            ->seeJson([
                'X' => 'R',
                'Y' => $input['d'] + ($input['d'] * ($input['e'] - $input['f']) / 100),
            ]);
    }

    /**
     * not_A_B_C
     */
    function testBaseMappingT()
    {
        $input = [
                'a' => 0, // false
                'b' => 1, // true
                'c' => 1, // true

            'd' => 10, 'e' => 20, 'f' => 30];

        $this->json('GET', '/insurance', $input)
            ->seeJson([
                'X' => 'T',
                'Y' => $input['d'] - ($input['d'] * $input['f'] / 100),
            ]);
    }

    /**
     * Specialized 1
     * A_B_C - specialized
     */
    function testSpecializedMappingR()
    {
        $input = [
            'a' => 1, // true
            'b' => 1, // true
            'c' => 1, // true

            'd' => 10, 'e' => 20, 'f' => 30,
            'specialized' => 1];

        $this->json('GET', '/insurance', $input)
            ->seeJson([
                'X' => 'R',
                'Y' => 2 * $input['d'] + ($input['d'] * $input['e'] / 100),
            ]);
    }

    /**
     * Specialized 2
     * A_B_not_C - specialized
     */
    function testSpecializedMappingT()
    {
        $input = [
            'a' => 1, // true
            'b' => 1, // true
            'c' => 0, // false

            'd' => 10, 'e' => 20, 'f' => 30,
            'specialized' => 1];

        $this->json('GET', '/insurance', $input)
            ->seeJson([
                'X' => 'T',
                'Y' => $input['d'] - ($input['d'] * $input['f'] / 100),
            ]);
    }

    /**
     * Specialized 2
     * A_not_B_C - specialized
     */
    function testSpecializedMappingS()
    {
        $input = [
            'a' => 1, // true
            'b' => 0, // false
            'c' => 1, // true

        'd' => 10, 'e' => 20, 'f' => 30,
        'specialized' => 1];

        $this->json('GET', '/insurance', $input)
            ->seeJson([
                'X' => 'S',
                'Y' => $input['f'] + $input['d'] + ($input['d'] * $input['e'] / 100),
            ]);
    }
}