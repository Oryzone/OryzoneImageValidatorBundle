<?php

namespace Oryzone\Bundle\ImageValidatorBundle\Validator\Image;

/**
 * @Annotation
 */
class Portrait extends ImageConstraint
{
    public $strict = false;

    public $errorMessage = 'The image has not portrait proportions. Dimensions: {{ width }} x {{ height }} px';

    /**
     * {@inheritDoc}
     */
    public function getDefaultOption()
    {
        return 'strict';
    }

}
