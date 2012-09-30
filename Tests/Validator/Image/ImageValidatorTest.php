<?php

namespace Oryzone\Bundle\ImageValidatorBundle\Tests\Validator\Image;


abstract class ImageValidatorTest extends \PHPUnit_Framework_TestCase
{

    protected $fixturesPath;
    protected $context;

    public function __construct($name = NULL, array $data = array(), $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->fixturesPath = __DIR__ . '/../../fixtures/';
    }

    public function setUp()
    {
        $this->context = $this->getMockBuilder('Symfony\Component\Validator\ExecutionContext')-> disableOriginalConstructor()->getMock();
    }

}