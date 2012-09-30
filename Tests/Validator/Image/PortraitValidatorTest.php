<?php

namespace Oryzone\Bundle\ImageValidatorBundle\Tests\Validator\Image;

use Oryzone\Bundle\ImageValidatorBundle\Validator\Image\PortraitValidator;
use Oryzone\Bundle\ImageValidatorBundle\Validator\Image\Portrait;

class PortraitValidatorTest extends ImageValidatorTest
{

    /**
     * @var PortraitValidator $validator
     */
    protected $validator;

    public function setUp()
    {
        parent::setUp();
        $this->validator = new PortraitValidator();
        $this->validator->initialize($this->context);
    }

    public function testPortraitImage()
    {
        $path = $this->fixturesPath . 'images/portrait-500x750.png';
        $valid = $this->validator->validate($path, new Portrait());
        $this->assertTrue($valid);
    }

    public function testPortraitImageWithSquareImage()
    {
        $path = $this->fixturesPath . 'images/square-200x200.jpg';
        $valid = $this->validator->validate($path, new Portrait());
        $this->assertTrue($valid);
    }

    public function testPortraitImageWithSquareImageStrictly()
    {
        $path = $this->fixturesPath . 'images/square-200x200.jpg';

        $portraitConstraint = new Portrait(array('strict' => true));

        $this->context->expects($this->once())
             ->method('addViolation')
             ->with($this->equalTo($portraitConstraint->errorMessage),
                $this->equalTo(array('{{ width }}' => 200, '{{ height }}' => 200)));

        $valid = $this->validator->isValid($path, $portraitConstraint);
        $this->assertFalse($valid);
    }

    public function testNotPortraitImage()
    {
        $path = $this->fixturesPath . 'images/landscape-700x441.jpg';
        $valid = $this->validator->validate($path, new Portrait());
        $this->assertFalse($valid);
    }

}
