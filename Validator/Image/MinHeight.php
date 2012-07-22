<?php

namespace Oryzone\Bundle\ImageValidatorBundle\Validator\Image;

/**
 * @Annotation
 */
class MinHeight extends ImageConstraint
{
    public $limit = false;

    public $errorMessage = 'Image height is too small. It should have to be at least {{ limit }} px. Current value {{ current }} px';

    /**
     * {@inheritDoc}
     */
    public function getDefaultOption()
    {
        return 'limit';
    }

    /**
     * {@inheritDoc}
     */
    public function getRequiredOptions()
    {
        return array('limit');
    }

}
