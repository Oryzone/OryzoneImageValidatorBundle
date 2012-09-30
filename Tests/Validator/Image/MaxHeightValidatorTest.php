<?php

namespace Oryzone\Bundle\ImageValidatorBundle\Tests\Validator\Image;

use Oryzone\Bundle\ImageValidatorBundle\Validator\Image\MaxHeightValidator;
use Oryzone\Bundle\ImageValidatorBundle\Validator\Image\MaxHeight;

class MaxHeightValidatorTest extends ImageValidatorTest
{

    /**
     * @var MaxHeightValidator $validator
     */
    protected $validator;

    public function setUp()
    {
        parent::setUp();
        $this->validator = new MaxHeightValidator();
        $this->validator->initialize($this->context);
    }

    public function testGoodImage()
    {
        $path = $this->fixturesPath . 'images/landscape-700x441.jpg';
        $valid = $this->validator->validate($path, new MaxHeight(array('limit' => 800)));
        $this->assertTrue($valid);
    }

    public function testBadImage()
    {
        $path = $this->fixturesPath . 'images/square-200x200.jpg';

        $maxHeightConstraint = new MaxHeight(array('limit' => 180));

        $this->context->expects($this->once())
            ->method('addViolation')
            ->with($this->equalTo($maxHeightConstraint->errorMessage),
                $this->equalTo(array('{{ current }}' => 200, '{{ limit }}' => 180)));

        $valid = $this->validator->validate($path, $maxHeightConstraint);
        $this->assertFalse($valid);
    }

    public function testLimitCase()
    {
        $path = $this->fixturesPath . 'images/square-200x200.jpg';
        $valid = $this->validator->validate($path, new MaxHeight(array('limit' => 200)));
        $this->assertTrue($valid);
    }

    /**
     * @expectedException Symfony\Component\Validator\Exception\MissingOptionsException
     */
    public function testNoLimitParameter()
    {
        new MaxHeight();
    }

}