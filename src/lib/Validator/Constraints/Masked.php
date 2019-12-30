<?php

declare(strict_types=1);

namespace MateuszBieniek\EzPlatformFormBuilderMaskedInput\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\MissingOptionsException;

class Masked extends Constraint
{
    /** @var string */
    public $mask = '';

    public function __construct($options = null)
    {
        parent::__construct($options);

        if (null !== $options && \is_array($options) && isset($options['mask'])) {
            $this->mask = $options['mask'];
        } else {
            throw new MissingOptionsException(sprintf('Option "mask" must be given for constraint %s', __CLASS__), ['mask']);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getTargets()
    {
        return Constraint::PROPERTY_CONSTRAINT;
    }

    /**
     * {@inheritdoc}
     */
    public function validatedBy()
    {
        return MaskedValidator::class;
    }
}
