<?php

namespace Oryzone\Bundle\ImageValidatorBundle\Tests\Validator\Image;

use Oryzone\Bundle\ImageValidatorBundle\Validator\Image\MaxWidthValidator;
use Oryzone\Bundle\ImageValidatorBundle\Validator\Image\MaxWidth;

class MaxWidthValidatorTest extends ImageValidatorTest
{

    /**
     * @var MaxWidthValidator $validator
     */
    protected $validator;

    public function setUp()
    {
        parent::setup();
        $this->validator = new MaxWidthValidator();
        $this->validator->initialize($this->context);
    }

    public function testGoodImage()
    {
        $path = $this->fixturesPath . 'images/landscape-700x441.jpg';
        $valid = $this->validator->validate($path, new MaxWidth(array('limit' => 800)));
        $this->assertTrue($valid);
    }

    public function testBadImage()
    {
        $path = $this->fixturesPath . 'images/square-200x200.jpg';

        $maxWidthConstraint = new MaxWidth(array('limit' => 180));

        $this->context->expects($this->once())
             ->method('addViolation')
             ->with($this->equalTo($maxWidthConstraint->errorMessage),
                $this->equalTo(array('{{ current }}' => 200, '{{ limit }}' => 180)));

        $valid = $this->validator->validate($path, $maxWidthConstraint);
        $this->assertFalse($valid);
    }

    public function testLimitCase()
    {
        $path = $this->fixturesPath . 'images/square-200x200.jpg';
        $valid = $this->validator->validate($path, new MaxWidth(array('limit' => 200)));
        $this->assertTrue($valid);
    }

    /**
     * @expectedException Symfony\Component\Validator\Exception\MissingOptionsException
     */
    public function testNoLimitParameter()
    {
        new MaxWidth();
    }

}