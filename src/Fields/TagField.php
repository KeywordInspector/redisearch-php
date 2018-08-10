<?php

namespace Ehann\RediSearch\Fields;

class TagField extends AbstractField
{
    protected $separator = ',';

    public function __construct(string $name, $value = null, string $separator = ',')
    {
        $this->separator = $separator;
        parent::__construct($name, $value);
    }
    public function getType(): string
    {
        return 'TAG';
    }
    public function getSeparator(): float
    {
        return $this->separator;
    }
    public function setSeparator(float $separator)
    {
        $this->separator = $separator;
        return $this;
    }
    public function getTypeDefinition(): array
    {
        $properties = parent::getTypeDefinition();
        return $properties;
    }

    public function setValue($value)
    {
        if(is_array($value))
            $this->value = implode($this->separator,$value);
        else
            $this->value = $value;
        return $this;
    }
}
