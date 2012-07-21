<?php

namespace Oryzone\Bundle\ImageValidatorBundle\Validator\Image;

/**
 * @Annotation
 */
class Landscape extends ImageConstraint
{
    public $strict = false;

    public $notLandscapeMessage = 'The image has not landscape proportions. Dimensions: {{ width }} x {{ height }} px';

    /**
     * {@inheritDoc}
     */
    public function getDefaultOption()
    {
        return 'strict';
    }

}
