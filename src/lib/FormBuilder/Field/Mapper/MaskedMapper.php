<?php

declare(strict_types=1);

namespace MateuszBieniek\EzPlatformFormBuilderMaskedInput\FormBuilder\Field\Mapper;

use EzSystems\EzPlatformFormBuilder\FieldType\Field\Mapper\GenericFieldMapper;
use EzSystems\EzPlatformFormBuilder\FieldType\Model\Field;

class MaskedMapper extends GenericFieldMapper
{
    /**
     * {@inheritdoc}
     */
    protected function mapFormOptions(Field $field, array $constraints): array
    {
        $options = parent::mapFormOptions($field, $constraints);
        $options['field'] = $field;
        $options['label'] = $field->getName();
        $options['attr'] = [
            'mask' => $field->getAttributeValue('mask'),
            'greedy' => $field->getAttributeValue('greedy'),
            'class' => 'mateuszbieniek-masked-input',
        ];

        $options['constraints'] = [
            //Todo
        ];

        return $options;
    }
}
