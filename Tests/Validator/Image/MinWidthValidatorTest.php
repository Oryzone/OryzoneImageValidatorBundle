<?php

namespace Oryzone\Bundle\ImageValidatorBundle\Tests\Validator\Image;

use Oryzone\Bundle\ImageValidatorBundle\Validator\Image\MinWidthValidator;
use Oryzone\Bundle\ImageValidatorBundle\Validator\Image\MinWidth;

class MinWidthValidatorTest extends ImageValidatorTest
{

    /**
     * @var MinWidthValidator $validator
     */
    protected $validator;

    public function setUp()
    {
        parent::setUp();
        $this->validator = new MinWidthValidator();
        $this->validator->initialize($this->context);
    }

    public function testGoodImage()
    {
        $path = $this->fixturesPath . 'images/landscape-700x441.jpg';
        $valid = $this->validator->validate($path, new MinWidth(array('limit' => 300)));
        $this->assertTrue($valid);
    }

    public function testBadImage()
    {
        $path = $this->fixturesPath . 'images/square-200x200.jpg';

        $minWidthConstraint = new MinWidth(array('limit' => 300));

        $this->context->expects($this->once())
             ->method('addViolation')
             ->with($this->equalTo($minWidthConstraint->errorMessage),
                $this->equalTo(array('{{ current }}' => 200, '{{ limit }}' => 300)));

        $valid = $this->validator->validate($path, $minWidthConstraint);
        $this->assertFalse($valid);
    }

    public function testLimitCase()
    {
        $path = $this->fixturesPath . 'images/square-200x200.jpg';
        $valid = $this->validator->validate($path, new MinWidth(array('limit' => 200)));
        $this->assertTrue($valid);
    }

    /**
     * @expectedException Symfony\Component\Validator\Exception\MissingOptionsException
     */
    public function testNoLimitParameter()
    {
        new MinWidth();
    }

}