<?php

namespace Oryzone\Bundle\ImageValidatorBundle\Validator\Image;

use Symfony\Component\Validator\Constraint;

/**
 * Abstract implementation for all the image constraints
 */
abstract class ImageConstraint extends Constraint
{
    public $notFoundMessage = 'The file could not be found';
    public $notReadableMessage = 'The file is not readable';

    public $uploadIniSizeErrorMessage = 'The file is too large. Allowed maximum size is {{ limit }}';
    public $uploadFormSizeErrorMessage = 'The file is too large';
    public $uploadErrorMessage = 'The file could not be uploaded';

    public $cannotReadImagePropertiesMessage = 'Cannot read properties of the image.';
}
