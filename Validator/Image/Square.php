<?php

namespace Oryzone\Bundle\ImageValidatorBundle\Validator\Image;

/**
 * @Annotation
 */
class Square extends ImageConstraint
{
    public $errorMessage = 'The image is not square. Dimensions: {{ width }} x {{ height }} px';
}
