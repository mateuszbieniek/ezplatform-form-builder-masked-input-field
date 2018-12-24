<?php
/**
 * Created by PhpStorm.
 * User: majzok
 * Date: 24.12.18
 * Time: 10:26
 */

namespace MateuszBieniek\EzPlatformFormBuilderMaskedInput\Form\Type;

use EzSystems\EzPlatformFormBuilder\Form\Type\Field\AbstractFieldType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class MaskedFieldType extends AbstractFieldType
{
    /**
     * {@inheritdoc}
     */
    public function getParent(): string
    {
        return TextType::class;
    }
}