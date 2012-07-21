<?php

namespace Oryzone\Bundle\ImageValidatorBundle\Tests\Validator\Image;

use Oryzone\Bundle\ImageValidatorBundle\Validator\Image\MaxWidthValidator;
use Oryzone\Bundle\ImageValidatorBundle\Validator\Image\MaxWidth;

class MaxWidthValidatorTest extends \PHPUnit_Framework_TestCase
{

    protected $validator;
    protected $fixturesPath;

    public function setUp()
    {
        $this->validator = new MaxWidthValidator();
        $this->fixturesPath = __DIR__ . '/../../fixtures/';
    }

    public function testGoodImage()
    {
        $path = $this->fixturesPath . 'images/landscape-700x441.jpg';
        $this->assertTrue($this->validator->isValid($path, new MaxWidth(array('limit' => 800))));
    }

    public function testBadImage()
    {
        $path = $this->fixturesPath . 'images/square-200x200.jpg';
        $this->assertFalse($this->validator->isValid($path, new MaxWidth(array('limit' => 180))));
    }

    public function testLimitCase()
    {
        $path = $this->fixturesPath . 'images/square-200x200.jpg';
        $this->assertTrue($this->validator->isValid($path, new MaxWidth(array('limit' => 200))));
    }

    /**
     * @expectedException Symfony\Component\Validator\Exception\MissingOptionsException
     */
    public function testNoLimitParameter()
    {
        new MaxWidth();
    }

}