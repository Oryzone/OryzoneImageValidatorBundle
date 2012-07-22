<?php

namespace Oryzone\Bundle\ImageValidatorBundle\Validator\Image;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class LandscapeValidator extends ImageValidator
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

        $valid = ( $width >= $height );

        if($constraint->strict)
            $valid = ( $width > $height );

        if (!$valid)
        {
            $this->setMessage($constraint->errorMessage, array(
                '{{ width }}' => $width,
                '{{ height }}' => $height,
            ));

            return false;
        }

        return true;
    }

}