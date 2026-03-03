<?php

namespace Pandao\Admin\Models;

class Filter
{
    public $name;
    public $label;
    public $value;
    public $type;
    public $options;
    public $filterName;
    public $optFilters;

    public function __construct ($name, $label, $type, $options, $filterName, $optFilters)
    {
        $this->name = $name;
        $this->label = $label;
        if(is_array($options))
            $this->options = $options;
        $this->filterName = $filterName;
        $this->optFilters = $optFilters;
        $this->type = $type;
    }

    function setValue($value)
    {
        $this->value = $value;
    }
}
