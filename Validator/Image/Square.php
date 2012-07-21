<?php

namespace Oryzone\Bundle\ImageValidatorBundle\Validator\Image;

/**
 * @Annotation
 */
class Square extends ImageConstraint
{
    public $notSquareMessage = 'The image is not square. Dimensions: {{ width }} x {{ height }} px';
}
