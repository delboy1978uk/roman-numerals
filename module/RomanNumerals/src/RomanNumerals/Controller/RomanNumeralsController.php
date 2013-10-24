<?php
/**
 * User: delboy1978uk
 * Date: 23/10/2013
 * Time: 01:08
 */

namespace RomanNumerals\Controller;
use RomanNumerals\Service\Converter;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;

class RomanNumeralsController  extends AbstractActionController
{
    /**
     * @var Converter
     */
    private $converter;

    public function indexAction()
    {
        $number = $this->params()->fromQuery('convert');
        if (preg_match("#^[0-9]+$#", $number))
        {
            try
            {
                $roman = $this->getRomanNumeralConverter()->generate($number);
                return new JsonModel(array(
                    'number' => $number,
                    'numerals' => $roman,
                    'success'=>true,
                ));
            }
            catch(\Exception $e)
            {
                return new JsonModel(array(
                    'message' => $e->getMessage(),
                    'success'=> false,
                ));
            }
        }
        elseif (preg_match("#^[IVXLCDM]+$#", $number))
        {
            $integer = $this->getRomanNumeralConverter()->parse($number);
            return new JsonModel(array(
                'roman' => $number,
                'integer' => $integer,
                'success'=>true,
            ));
        }
        else
        {
            return new JsonModel(array(
                'message' => 'Convert parameter must be an integer or Roman Numerals',
                'success'=> false,
            ));
        }
    }

    /**
     * @return Converter
     */
    private function getRomanNumeralConverter()
    {
        if(!$this->converter)
        {
            $this->converter = new Converter();
        }
        return $this->converter;
    }
}