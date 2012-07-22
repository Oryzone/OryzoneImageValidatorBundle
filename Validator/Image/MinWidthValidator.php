<?php

namespace Oryzone\Bundle\ImageValidatorBundle\Validator\Image;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class MinWidthValidator extends ImageValidator
{

    public function isValid($value, Constraint $constraint)
    {
        if (!parent::isValid($value, $constraint))
            return false;

        $info = getimagesize($this->imagePath);
        if(!$info || !isset($info[0]))
        {
            $this->setMessage($constraint->cannotReadImagePropertiesMessage);
            return false;
        }

        $width = $info[0];

        if ( $width < $constraint->limit )
        {
            $this->setMessage($constraint->errorMessage, array(
                '{{ current }}' => $width,
                '{{ limit }}' => $constraint->limit,
            ));

            return false;
        }

        return true;
    }

}