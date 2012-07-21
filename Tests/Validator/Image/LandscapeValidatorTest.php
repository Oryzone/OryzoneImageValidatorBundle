<?php

namespace Oryzone\Bundle\ImageValidatorBundle\Tests\Validator\Image;

use Oryzone\Bundle\ImageValidatorBundle\Validator\Image\LandscapeValidator;
use Oryzone\Bundle\ImageValidatorBundle\Validator\Image\Landscape;

class LandscapeValidatorTest extends \PHPUnit_Framework_TestCase
{

    protected $validator;
    protected $fixturesPath;

    public function setUp()
    {
        $this->validator = new LandscapeValidator();
        $this->fixturesPath = __DIR__ . '/../../fixtures/';
    }

    public function testLandscapeImage()
    {
        $path = $this->fixturesPath . 'images/landscape-700x441.jpg';
        $this->assertTrue($this->validator->isValid($path, new Landscape()));
    }

    public function testLandscapeImageWithSquareImage()
    {
        $path = $this->fixturesPath . 'images/square-200x200.jpg';
        $this->assertTrue($this->validator->isValid($path, new Landscape()));
    }

    public function testLandscapeImageWithSquareImageStrictly()
    {
        $path = $this->fixturesPath . 'images/square-200x200.jpg';
        $this->assertFalse($this->validator->isValid($path, new Landscape(array('strict' => true))));
    }

    public function testNotLandscapeImage()
    {
        $path = $this->fixturesPath . 'images/portrait-500x750.png';
        $this->assertFalse($this->validator->isValid($path, new Landscape()));
    }

}