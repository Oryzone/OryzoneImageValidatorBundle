<?php

namespace Oryzone\Bundle\ImageValidatorBundle\Validator\Image;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\ConstraintDefinitionException;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\HttpFoundation\File\File as FileObject;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Base implementation for image validators
 */
abstract class ImageValidator extends ConstraintValidator
{

    /**
     * Used to store the path of the image after a call to isValid
     *
     * @var string $imagePath
     */
    protected $imagePath;

    /**
     * Checks if the passed value is valid.
     *
     * @param mixed      $value      The value that should be validated
     * @param Constraint $constraint The constraint for the validation
     *
     * @return Boolean Whether or not the value is valid
     *
     * @api
     */
    public function isValid($value, Constraint $constraint)
    {
        if (null === $value || '' === $value) {
            return true;
        }

        if ($value instanceof UploadedFile && !$value->isValid()) {
            switch ($value->getError()) {
                case UPLOAD_ERR_INI_SIZE:
                    $maxSize = UploadedFile::getMaxFilesize();
                    $maxSize = $constraint->maxSize ? min($maxSize, $constraint->maxSize) : $maxSize;
                    $this->context->addViolation($constraint->uploadIniSizeErrorMessage, array('{{ limit }}' => $maxSize.' bytes'), $value);

                    return false;
                case UPLOAD_ERR_FORM_SIZE:
                    $this->context->addViolation($constraint->uploadFormSizeErrorMessage, $value);

                    return false;
                default:
                    $this->context->addViolation($constraint->uploadErrorMessage, array(), $value);

                    return false;
            }
        }

        if (!is_scalar($value) && !$value instanceof FileObject && !(is_object($value) && method_exists($value, '__toString'))) {
            throw new UnexpectedTypeException($value, 'string');
        }

        $this->imagePath = $value instanceof FileObject ? $value->getPathname() : (string) $value;

        if (!file_exists($this->imagePath)) {
            $this->context->addViolation($constraint->notFoundMessage, array('{{ file }}' => $this->imagePath), $this->imagePath);

            return false;
        }

        if (!is_readable($this->imagePath)) {
            $this->context->addViolation($constraint->notReadableMessage, array('{{ file }}' => $this->imagePath), $this->imagePath);

            return false;
        }

        return true;
    }

}
