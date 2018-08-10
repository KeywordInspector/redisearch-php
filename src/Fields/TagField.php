<?php

namespace Ehann\RediSearch\Fields;

class TagField extends AbstractField
{
    public function getType(): string
    {
        return 'TAG';
    }
    public function getTypeDefinition(): array
    {
        $properties = parent::getTypeDefinition();
        return $properties;
    }
}
