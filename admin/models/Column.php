<?php

namespace Pandao\Admin\Models;

use Pandao\Common\Utils\StrUtils;

/**
 * Class of the columns displayed in the listing of a module
 */
class Column
{
    public $name;
    public $label;
    public $type;
    public $link;
    public $table;
    public $fieldRef;
    public $fieldValue;

    private $caseValues;
    public $values;

    public function __construct($name, $label, $type, $link, $table, $fieldRef, $fieldValue, $caseValues)
    {
        $this->name = $name;
        $this->label = $label;
        $this->type = $type;
        $this->link = $link;
        $this->values = array();
        $this->table = $table;
        $this->fieldRef = $fieldRef;
        $this->fieldValue = $fieldValue;
        $this->caseValues = $caseValues;
    }

    public function getValue($row)
    {
        return !empty($this->values[$row]) ? $this->values[$row] : null;
    }

    public function getCaseValue($case)
    {
        return !empty($this->caseValues[$case]) ? htmlentities($this->caseValues[$case], ENT_QUOTES, "UTF-8") : $case;
    }

    public function setValue($row, $value)
    {
        $this->values[$row] = empty($this->link) ? StrUtils::encodeIfHtml($value) : $value;
    }
}
