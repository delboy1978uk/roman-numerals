<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;
use RomanNumerals\Service\Converter;

//
// Require 3rd-party libraries here:
//
// require_once 'PHPUnit/Autoload.php';
// require_once 'PHPUnit/Framework/Assert/Functions.php';
//


/**
 * Features context.
 */
class FeatureContext extends MinkContext
{
    /** @var \Zend\Mvc\Application **/
    private static $zendapp;
    /** @var RomanNumerals\Service\Converter */
    private static $converter;

    /** @BeforeSuite */
    static public function initialiseZendFramework()
    {
        if(self::$zendapp === null)
        {
            $path = __DIR__ .'/../../../../config/application.config.php';
            self::$zendapp = Zend\Mvc\Application::init(
                require $path
            );
        }
    }

    /** @BeforeSuite */
    static public function initialiseRomanNumeralService()
    {
        self::$converter = new Converter();
    }


    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        // Initialize your context here
    }



    /**
     * @Then /^I should get a response$/
     */
    public function iShouldGetAResponse()
    {
        $response = $this->getSession()->getPage()->getContent();
        if (empty($response)) {
            throw new Exception('No response from the API!');
        }
    }

    /**
     * @Given /^the response should be JSON$/
     */
    public function theResponseShouldBeJson()
    {
        $json = $this->getSession()->getPage()->getContent();
        $data = json_decode($json);
        if (empty($data)) {
            throw new Exception("Response was not JSON" . $json);
        }
    }


    /**
     * @Given /^I can convert the number "([^"]*)" to "([^"]*)"$/
     */
    public function iCanConvertTheNumberTo($arg1, $arg2)
    {
        if(self::$converter->generate($arg1) != $arg2)
        {
            throw new Exception('Number did not convert');
        }
    }

    /**
     * @Given /^I can convert the numerals "([^"]*)" to "([^"]*)"$/
     */
    public function iCanConvertTheNumeralsTo($arg1, $arg2)
    {
        if(self::$converter->parse($arg1) != $arg2)
        {
            throw new Exception('Numerals did not convert');
        }
    }

}
