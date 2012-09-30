<?php

namespace Oryzone\Bundle\ImageValidatorBundle\Tests\Validator\Image;

use Oryzone\Bundle\ImageValidatorBundle\Validator\Image\LandscapeValidator;
use Oryzone\Bundle\ImageValidatorBundle\Validator\Image\Landscape;

class LandscapeValidatorTest extends ImageValidatorTest
{

    /**
     * @var LandscapeValidator $validator
     */
    protected $validator;

    public function setUp()
    {
        parent::setUp();
        $this->validator = new LandscapeValidator();
        $this->validator->initialize($this->context);
    }

    public function testLandscapeImage()
    {
        $path = $this->fixturesPath . 'images/landscape-700x441.jpg';
        $valid = $this->validator->validate($path, new Landscape());
        $this->assertTrue($valid);
    }

    public function testLandscapeImageWithSquareImage()
    {
        $path = $this->fixturesPath . 'images/square-200x200.jpg';
        $valid = $this->validator->validate($path, new Landscape());
        $this->assertTrue($valid);
    }

    public function testLandscapeImageWithSquareImageStrictly()
    {
        $path = $this->fixturesPath . 'images/square-200x200.jpg';

        $landscapeConstraint = new Landscape(array('strict' => true));

        $this->context->expects($this->once())
             ->method('addViolation')
             ->with($this->equalTo($landscapeConstraint->errorMessage),
                   $this->equalTo(array('{{ width }}' => 200, '{{ height }}' => 200)));

        $valid = $this->validator->validate($path, $landscapeConstraint);
        $this->assertFalse($valid);
    }

    public function testNotLandscapeImage()
    {
        $path = $this->fixturesPath . 'images/portrait-500x750.png';

        $landscapeConstraint = new Landscape(array());

        $this->context->expects($this->once())
             ->method('addViolation')
             ->with($this->equalTo($landscapeConstraint->errorMessage),
                   $this->equalTo(array('{{ width }}' => 500, '{{ height }}' => 750)));

        $valid = $this->validator->validate($path, $landscapeConstraint);
        $this->assertFalse($valid);
    }

}