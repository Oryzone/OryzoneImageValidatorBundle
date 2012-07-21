<?php

namespace Oryzone\Bundle\ImageValidatorBundle\Tests\Validator\Image;

use Oryzone\Bundle\ImageValidatorBundle\Validator\Image\SquareValidator;
use Oryzone\Bundle\ImageValidatorBundle\Validator\Image\Square;

class SquareValidatorTest extends \PHPUnit_Framework_TestCase
{

    protected $validator;
    protected $fixturesPath;

    public function setUp()
    {
        $this->validator = new SquareValidator();
        $this->fixturesPath = __DIR__ . '/../../fixtures/';
    }

    public function testSquareImage()
    {
        $path = $this->fixturesPath . 'images/square-200x200.jpg';
        $this->assertTrue($this->validator->isValid($path, new Square()));
    }

    public function testNotSquareImage()
    {
        $path = $this->fixturesPath . 'images/portrait-500x750.jpg';
        $this->assertFalse($this->validator->isValid($path, new Square()));
    }

}
