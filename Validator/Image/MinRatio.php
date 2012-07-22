<?php

namespace Oryzone\Bundle\ImageValidatorBundle\Validator\Image;

/**
 * @Annotation
 */
class MinRatio extends ImageConstraint
{
    public $limit = false;

    public $errorMessage = 'Image ratio is too small. It should have to be at least {{ limit }}. Current value {{ current }}';

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
