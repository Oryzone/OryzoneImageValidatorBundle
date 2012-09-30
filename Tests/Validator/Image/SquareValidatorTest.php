<?php

namespace Oryzone\Bundle\ImageValidatorBundle\Tests\Validator\Image;

use Oryzone\Bundle\ImageValidatorBundle\Validator\Image\SquareValidator;
use Oryzone\Bundle\ImageValidatorBundle\Validator\Image\Square;

class SquareValidatorTest extends ImageValidatorTest
{

    /**
     * @var SquareValidator $validator
     */
    protected $validator;

    public function setUp()
    {
        parent::setUp();
        $this->validator = new SquareValidator();
        $this->validator->initialize($this->context);
    }

    public function testSquareImage()
    {
        $path = $this->fixturesPath . 'images/square-200x200.jpg';
        $valid = $this->validator->validate($path, new Square());
        $this->assertTrue($valid);
    }

    public function testNotSquareImage()
    {
        $path = $this->fixturesPath . 'images/portrait-500x750.png';

        $squareConstraint = new Square();

        $this->context->expects($this->once())
             ->method('addViolation')
             ->with($this->equalTo($squareConstraint->errorMessage),
                    $this->equalTo(array('{{ width }}' => 500, '{{ height }}' => 750)));

        $valid = $this->validator->isValid($path, $squareConstraint);
        $this->assertFalse($valid);
    }

}
