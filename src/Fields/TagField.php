<?php

namespace Ehann\RediSearch\Fields;

class TagField extends AbstractField
{
    public function __construct(string $name, $value = null)
    {
        $this->name = $name;
        $this->value = $value;
    }
    public function getType(): string
    {
        return 'TAG';
    }
    public function getTypeDefinition(): array
    {
        $properties = parent::getTypeDefinition();
        return $properties;
    }

    public function setValue($value)
    {
        $this->value = implode(', ',$value);
        return $this;
    }
}
