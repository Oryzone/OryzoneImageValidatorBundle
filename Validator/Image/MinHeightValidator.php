<?php

namespace Oryzone\Bundle\ImageValidatorBundle\Validator\Image;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class MinHeightValidator extends ImageValidator
{

    public function isValid($value, Constraint $constraint)
    {
        if (!parent::isValid($value, $constraint))
            return false;

        $info = getimagesize($this->imagePath);
        if(!$info || !isset($info[1]))
        {
            $this->context->addViolation($constraint->cannotReadImagePropertiesMessage, array(), $value);
            return false;
        }

        $height = $info[1];

        if ( $height < $constraint->limit )
        {
            $this->context->addViolation($constraint->errorMessage, array(
                '{{ current }}' => $height,
                '{{ limit }}' => $constraint->limit,
            ), $value);

            return false;
        }

        return true;
    }

}