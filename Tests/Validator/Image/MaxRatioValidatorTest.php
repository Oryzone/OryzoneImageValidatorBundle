<?php

namespace Oryzone\Bundle\ImageValidatorBundle\Tests\Validator\Image;

use Oryzone\Bundle\ImageValidatorBundle\Validator\Image\MaxRatioValidator;
use Oryzone\Bundle\ImageValidatorBundle\Validator\Image\MaxRatio;

class MaxRatioValidatorTest extends ImageValidatorTest
{

    /**
     * @var MaxRatioValidator $validator
     */
    protected $validator;

    public function setUp()
    {
        parent::setUp();
        $this->validator = new MaxRatioValidator();
        $this->validator->initialize($this->context);
    }

    public function testGoodImage()
    {
        $path = $this->fixturesPath . 'images/landscape-700x441.jpg';
        $valid = $this->validator->validate($path, new MaxRatio(array('limit' => 1.6)));
        $this->assertTrue($valid);
    }

    public function testBadImage()
    {
        $path = $this->fixturesPath . 'images/square-200x200.jpg';
        $maxRatioConstraint = new MaxRatio(array('limit' => 0.5));

        $this->context->expects($this->once())
             ->method('addViolation')
             ->with($this->equalTo($maxRatioConstraint->errorMessage),
                $this->equalTo(array('{{ current }}' => 1, '{{ limit }}' => 0.5)));

        $valid = $this->validator->validate($path, $maxRatioConstraint);
        $this->assertFalse($valid);
    }

    public function testLimitCase()
    {
        $path = $this->fixturesPath . 'images/square-200x200.jpg';
        $valid = $this->validator->validate($path, new MaxRatio(array('limit' => 1.0)));
        $this->assertTrue($valid);
    }

    /**
     * @expectedException Symfony\Component\Validator\Exception\MissingOptionsException
     */
    public function testNoLimitParameter()
    {
        new MaxRatio();
    }
}