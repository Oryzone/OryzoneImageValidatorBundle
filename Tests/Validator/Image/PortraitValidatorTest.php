<?php

namespace Oryzone\Bundle\ImageValidatorBundle\Tests\Validator\Image;

use Oryzone\Bundle\ImageValidatorBundle\Validator\Image\PortraitValidator;
use Oryzone\Bundle\ImageValidatorBundle\Validator\Image\Portrait;

class PortraitValidatorTest extends \PHPUnit_Framework_TestCase
{

    protected $validator;
    protected $fixturesPath;

    public function setUp()
    {
        $this->validator = new PortraitValidator();
        $this->fixturesPath = __DIR__ . '/../../fixtures/';
    }

    public function testPortraitImage()
    {
        $path = $this->fixturesPath . 'images/portrait-500x750.png';
        $this->assertTrue($this->validator->isValid($path, new Portrait()));
    }

    public function testPortraitImageWithSquareImage()
    {
        $path = $this->fixturesPath . 'images/square-200x200.jpg';
        $this->assertTrue($this->validator->isValid($path, new Portrait()));
    }

    public function testPortraitImageWithSquareImageStrictly()
    {
        $path = $this->fixturesPath . 'images/square-200x200.jpg';
        $this->assertFalse($this->validator->isValid($path, new Portrait(array('strict' => true))));
    }

    public function testNotPortraitImage()
    {
        $path = $this->fixturesPath . 'images/landscape-700x441.jpg';
        $this->assertFalse($this->validator->isValid($path, new Portrait()));
    }

}
