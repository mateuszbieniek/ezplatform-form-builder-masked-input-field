<?php

declare(strict_types=1);

namespace MateuszBieniek\EzPlatformFormBuilderMaskedInput\FormBuilder\Field\Mapper;

use EzSystems\EzPlatformFormBuilder\FieldType\Field\Mapper\GenericFieldMapper;
use EzSystems\EzPlatformFormBuilder\FieldType\Model\Field;
use MateuszBieniek\EzPlatformFormBuilderMaskedInput\Validator\Constraints\Masked;

class MaskedMapper extends GenericFieldMapper
{
    /**
     * {@inheritdoc}
     */
    protected function mapFormOptions(Field $field, array $constraints): array
    {
        $mask = $field->getAttributeValue('mask');
        $greedy = (bool) $field->getAttributeValue('greedy');

        $options = parent::mapFormOptions($field, $constraints);
        $options['field'] = $field;
        $options['label'] = $field->getName();
        $options['attr'] = [
            'mask' => $mask,
            'greedy' => $greedy,
            'class' => 'mateuszbieniek-masked-input',
        ];

        $constraintOptions = [];
        $constraintOptions['mask'] = $mask;

        $required = false;

        foreach ($field->getValidators() as $validator) {
            if ($validator->getIdentifier() === 'required' && (bool) $validator->getValue() === true) {
                $required = true;
                break;
            }
        }

        if ($required) {
            $options['constraints'] = [
                new Masked($constraintOptions),
            ];
        }

        return $options;
    }
}
