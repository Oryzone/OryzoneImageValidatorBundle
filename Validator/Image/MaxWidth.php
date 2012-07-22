<?php

namespace Oryzone\Bundle\ImageValidatorBundle\Validator\Image;

/**
 * @Annotation
 */
class MaxWidth extends ImageConstraint
{
    public $limit = false;

    public $errorMessage = 'Image width is too big. It should have to be {{ limit }} px maximum. Current value {{ current }} px';

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
