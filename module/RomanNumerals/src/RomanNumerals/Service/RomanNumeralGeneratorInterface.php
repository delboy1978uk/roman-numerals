<?php
/**
 * User: delboy1978uk
 * Date: 24/10/2013
 * Time: 20:40
 */

namespace RomanNumerals\Service;

interface RomanNumeralGeneratorInterface
{
    /**
     * convert from int -> roman
     * @var int $integer
     */
    public function generate($integer);

    /**
     * convert from roman -> int
     * @var string $string
     */
    public function  parse($string);
}