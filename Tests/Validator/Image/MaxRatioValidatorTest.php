<?php

namespace Oryzone\Bundle\ImageValidatorBundle\Tests\Validator\Image;

use Oryzone\Bundle\ImageValidatorBundle\Validator\Image\MaxRatioValidator;
use Oryzone\Bundle\ImageValidatorBundle\Validator\Image\MaxRatio;

class MaxRatioValidatorTest extends \PHPUnit_Framework_TestCase
{

    protected $validator;
    protected $fixturesPath;

    public function setUp()
    {
        $this->validator = new MaxRatioValidator();
        $this->fixturesPath = __DIR__ . '/../../fixtures/';
    }

    public function testGoodImage()
    {
        $path = $this->fixturesPath . 'images/landscape-700x441.jpg';
        $this->assertTrue($this->validator->isValid($path, new MaxRatio(array('limit' => 1.6))));
    }

    public function testBadImage()
    {
        $path = $this->fixturesPath . 'images/square-200x200.jpg';
        $this->assertFalse($this->validator->isValid($path, new MaxRatio(array('limit' => 0.5))));
    }

    public function testLimitCase()
    {
        $path = $this->fixturesPath . 'images/square-200x200.jpg';
        $this->assertTrue($this->validator->isValid($path, new MaxRatio(array('limit' => 1.0))));
    }

    /**
     * @expectedException Symfony\Component\Validator\Exception\MissingOptionsException
     */
    public function testNoLimitParameter()
    {
        new MaxRatio();
    }
}