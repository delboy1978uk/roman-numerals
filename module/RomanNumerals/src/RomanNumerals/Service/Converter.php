<?php
/**
 * User: delboy1978uk
 * Date: 23/10/2013
 * Time: 01:47
 */

namespace RomanNumerals\Service;

class Converter implements RomanNumeralGeneratorInterface
{
    /** @var array */
    private $numerals;

    public function __construct()
    {
        $this->numerals = array(
            'M' => 1000,
            'CM' => 900,
            'D' => 500,
            'CD' => 400,
            'C' => 100,
            'XC' => 90,
            'L' => 50,
            'XL' => 40,
            'X' => 10,
            'IX' => 9,
            'V' => 5,
            'IV' => 4,
            'I' => 1,
        );
    }


    /**
     * @param int $integer
     * @return string
     * @throws \Exception
     */
    public function generate($integer)
    {
        //numbers only using regex (black magic)
        if (!preg_match("#^[0-9]+$#", $integer))
        {
            throw new \Exception('Integers only please.');
        }

        //within specified range
        if($integer < 1 || $integer > 3999)
        {
            throw new \Exception('Numbers outwith limit of 1 and 3999.');
        }

        // start with a blank string
        $numerals = '';

        //keep going till no more numbers to convert
        while($integer > 0)
        {
            //loop through our array
            foreach ($this->numerals as $key => $value)
            {
                //if its less than our number we can write the numeral down
                if($value <= $integer)
                {
                    //write down the numeral
                    $numerals .= $key;
                    //deduct its value
                    $integer = $integer - $value;
                    //come out of this loop
                    break;
                }
            }
        }

        return $numerals;
    }






    /**
     * @param string $string
     * @return int
     * @throws \Exception
     */
    public function  parse($string)
    {
        //uppercase string in case they sent us lower case letters
        $string = strtoupper($string);

        //make sure only roman characters using regex (black magic)
        if (!preg_match("#^[IVXLCDM]+$#", $string)) {
            throw new \Exception('Characters must only be roman numerals');
        }

        //start at zero
        $count = 0;

        //loop through our array
        foreach ($this->numerals as $key => $value)
        {
            //look for numeral from the array in our string
            while (strpos($string, $key) === 0)
            {
                //add the value
                $count = $count + $value;

                //get the string length of the numeral we converted
                $length = strlen($key);

                //chop the numerals off the start of the string
                $string = substr($string, $length);
            }
        }
        return $count;
    }


}