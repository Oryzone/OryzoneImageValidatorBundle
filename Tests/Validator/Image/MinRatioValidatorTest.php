<?php

namespace Oryzone\Bundle\ImageValidatorBundle\Tests\Validator\Image;

use Oryzone\Bundle\ImageValidatorBundle\Validator\Image\MinRatioValidator;
use Oryzone\Bundle\ImageValidatorBundle\Validator\Image\MinRatio;

class MinRatioValidatorTest extends ImageValidatorTest
{

    /**
     * @var MinRatioValidator $validator
     */
    protected $validator;

    public function setUp()
    {
        parent::setUp();
        $this->validator = new MinRatioValidator();
        $this->validator->initialize($this->context);
    }

    public function testGoodImage()
    {
        $path = $this->fixturesPath . 'images/landscape-700x441.jpg';
        $valid = $this->validator->validate($path, new MinRatio(array('limit' => 0.2)));
        $this->assertTrue($valid);
    }

    public function testBadImage()
    {
        $path = $this->fixturesPath . 'images/square-200x200.jpg';
        $minRatioConstraint = new MinRatio(array('limit' => 1.1));

        $this->context->expects($this->once())
             ->method('addViolation')
             ->with($this->equalTo($minRatioConstraint->errorMessage),
                $this->equalTo(array('{{ current }}' => 1.0, '{{ limit }}' => 1.1)));

        $valid = $this->validator->validate($path, $minRatioConstraint);
        $this->assertFalse($valid);
    }

    public function testLimitCase()
    {
        $path = $this->fixturesPath . 'images/square-200x200.jpg';
        $valid = $this->validator->validate($path, new MinRatio(array('limit' => 1.0)));
        $this->assertTrue($valid);
    }

    /**
     * @expectedException Symfony\Component\Validator\Exception\MissingOptionsException
     */
    public function testNoLimitParameter()
    {
        new MinRatio();
    }

}