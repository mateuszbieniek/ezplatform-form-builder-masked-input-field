<?php

declare(strict_types=1);

namespace MateuszBieniek\EzPlatformFormBuilderMaskedInput\Validator\Constraints;

use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class MaskedValidator extends ConstraintValidator
{
    private const MESSAGE = 'Value must match the format: %s';

    /**
     * {@inheritdoc}
     */
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof Masked) {
            throw new UnexpectedTypeException($constraint, __NAMESPACE__ . '\Masked');
        }

        if (empty($value)) {
            return;
        }

        $mask = $constraint->mask;
        $regex = $this->generateRegex($mask);

        if (!preg_match($regex, $value)) {
            $this->context->addViolation(
                sprintf(
                    self::MESSAGE,
                    str_replace('\\', '', $mask)
                )
            );
        }
    }

    private function generateRegex($mask)
    {
        $regex = '/';
        $regexSpecialChars = [
            '[',
            '\\',
            '^',
            '$',
            '.',
            '|',
            '?',
            '*',
            '+',
            '(',
            ')',
            '{',
            '}',
        ];

        $escape = false;
        foreach (str_split($mask) as $char) {
            if ($escape) {
                if (\in_array($char, $regexSpecialChars)) {
                    $char = '\\' . $char;
                }
                $regex .= $char;
                $escape = false;

                continue;
            }

            switch ($char) {
                case '\\':
                    $escape = true;
                    break;
                case '9':
                    $regex .= '[0-9]';
                    break;
                case 'a':
                    $regex .= '[A-z]';
                    break;
                case '*':
                    $regex .= '[0-9A-z]';
                    break;
                case '[':
                    $regex .= '(?:(';
                    break;
                case ']':
                    $regex .= ')?)';
                    break;
                default:
                    if (\in_array($char, $regexSpecialChars)) {
                        $regex .= '\\' . $char;
                    } else {
                        $regex .= $char;
                    }
            }
        }
        $regex .= '/';

        return $regex;
    }
}
