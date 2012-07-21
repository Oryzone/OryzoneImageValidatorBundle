<?php

namespace Oryzone\Bundle\ImageValidatorBundle\Validator\Image;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class MinRatioValidator extends ImageValidator
{

    public function isValid($value, Constraint $constraint)
    {
        if (!parent::isValid($value, $constraint))
            return false;

        $info = getimagesize($this->imagePath);
        if(!$info || !isset($info[0]) || !isset($info[1]))
        {
            $this->setMessage($constraint->cannotReadImagePropertiesMessage);
            return false;
        }

        $width = $info[0];
        $height = $info[1];

        $ratio = (float)$width / (float)$height;

        if ( $ratio < $constraint->limit )
        {
            $this->setMessage($constraint->ratioTooSmallMessage, array(
                '{{ current }}' => $ratio,
                '{{ limit }}' => $constraint->limit,
            ));

            return false;
        }

        return true;
    }

}