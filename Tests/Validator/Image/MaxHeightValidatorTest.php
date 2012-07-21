<?php

namespace Oryzone\Bundle\ImageValidatorBundle\Tests\Validator\Image;

use Oryzone\Bundle\ImageValidatorBundle\Validator\Image\MaxHeightValidator;
use Oryzone\Bundle\ImageValidatorBundle\Validator\Image\MaxHeight;

class MaxHeightValidatorTest extends \PHPUnit_Framework_TestCase
{

    protected $validator;
    protected $fixturesPath;

    public function setUp()
    {
        $this->validator = new MaxHeightValidator();
        $this->fixturesPath = __DIR__ . '/../../fixtures/';
    }

    public function testGoodImage()
    {
        $path = $this->fixturesPath . 'images/landscape-700x441.jpg';
        $this->assertTrue($this->validator->isValid($path, new MaxHeight(array('limit' => 800))));
    }

    public function testBadImage()
    {
        $path = $this->fixturesPath . 'images/square-200x200.jpg';
        $this->assertFalse($this->validator->isValid($path, new MaxHeight(array('limit' => 180))));
    }

    public function testLimitCase()
    {
        $path = $this->fixturesPath . 'images/square-200x200.jpg';
        $this->assertTrue($this->validator->isValid($path, new MaxHeight(array('limit' => 200))));
    }

    /**
     * @expectedException Symfony\Component\Validator\Exception\MissingOptionsException
     */
    public function testNoLimitParameter()
    {
        new MaxHeight();
    }

}