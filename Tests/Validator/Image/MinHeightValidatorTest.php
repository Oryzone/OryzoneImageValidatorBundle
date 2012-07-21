<?php

namespace Oryzone\Bundle\ImageValidatorBundle\Tests\Validator\Image;

use Oryzone\Bundle\ImageValidatorBundle\Validator\Image\MinHeightValidator;
use Oryzone\Bundle\ImageValidatorBundle\Validator\Image\MinHeight;

class MinHeightValidatorTest extends \PHPUnit_Framework_TestCase
{

    protected $validator;
    protected $fixturesPath;

    public function setUp()
    {
        $this->validator = new MinHeightValidator();
        $this->fixturesPath = __DIR__ . '/../../fixtures/';
    }

    public function testGoodImage()
    {
        $path = $this->fixturesPath . 'images/landscape-700x441.jpg';
        $this->assertTrue($this->validator->isValid($path, new MinHeight(array('limit' => 300))));
    }

    public function testBadImage()
    {
        $path = $this->fixturesPath . 'images/square-200x200.jpg';
        $this->assertFalse($this->validator->isValid($path, new MinHeight(array('limit' => 300))));
    }

    /**
     * @expectedException Symfony\Component\Validator\Exception\MissingOptionsException
     */
    public function testNoLimitParameter()
    {
        new MinHeight();
    }

}