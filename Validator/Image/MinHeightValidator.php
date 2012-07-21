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
            $this->setMessage($constraint->cannotReadImagePropertiesMessage);
            return false;
        }

        $height = $info[1];

        if ( $height < $constraint->limit )
        {
            $this->setMessage($constraint->heightTooSmallMessage, array(
                '{{ current }}' => $height,
                '{{ limit }}' => $constraint->limit,
            ));

            return false;
        }

        return true;
    }

}