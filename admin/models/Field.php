<?php

namespace Pandao\Admin\Models;

/**
 * Class of the fields displayed in the form of a module
 */
class Field
{
    private $values;
    private $notices;

    public $name;
    public $label;
    public $type;
    public $required;
    public $options;
    public $validation;
    public $multilingual;
    public $unique;
    public $comment;
    public $active;
    public $editor;
    public $optionTable;
    public $roles;
    public $filterName;
    public $optFilters;

    /**
     * Field constructor.
     */
    public function __construct($name, $label, $type, $required, $validation, $options, $multilingual, $unique, $comment, $active, $editor, $optionTable, $roles, $filterName, $optFilters)
    {
        $this->name = $name;
        $this->label = $label;
        $this->type = $type;
        if (is_numeric($required) && ($required == 1 || $required == 0))
            $this->required = $required;
        if (is_array($options))
            $this->options = $options;
        $this->validation = $validation;
        $this->values = array();
        if (is_numeric($multilingual) && ($multilingual == 1 || $multilingual == 0))
            $this->multilingual = $multilingual;
        if (is_numeric($unique) && ($unique == 1 || $unique == 0))
            $this->unique = $unique;
        else
            $this->active = 0;
        $this->comment = $comment;
        if (is_numeric($active) && ($active == 1 || $active == 0))
            $this->active = $active;
        else
            $this->active = 1;
        if (is_numeric($editor) && ($editor == 1 || $editor == 0))
            $this->editor = $editor;
        else
            $this->editor = 0;
        $this->notices = array();
        $this->optionTable = $optionTable;
        $this->roles = $roles;
        $this->filterName = $filterName;
        $this->optFilters = $optFilters;
    }

    public function getValue($encode = false, $index = 0, $id_lang = PMS_DEFAULT_LANG)
    {
        if (!MULTILINGUAL) $id_lang = 0;
        if (isset($this->values[$index][$id_lang])) {
            if (!is_array($this->values[$index][$id_lang]))
                return ($encode) ? htmlentities($this->values[$index][$id_lang], ENT_QUOTES, "UTF-8") : stripslashes($this->values[$index][$id_lang]);
            else
                return $this->values[$index][$id_lang];
        } else
            return "";
    }

    public function removeValue($index)
    {
        if (isset($this->values[$index]))
            unset($this->values[$index]);
    }

    public function getAllValues($id_lang = null)
    {
        if (!is_null($id_lang)) {
            $all_values = array();
            if (!MULTILINGUAL) $id_lang = 0;
            foreach ($this->values as $i => $values) {
                if (isset($values[$id_lang])) {
                    if (!is_array($values[$id_lang]))
                        $all_values[$i][$id_lang] = stripslashes($values[$id_lang]);
                    else
                        $all_values[$i][$id_lang] = $values[$id_lang];
                }
            }
            return $all_values;
        } else
            return $this->values;
    }

    public function getNotice($index = 0)
    {
        if (isset($this->notices[$index]))
            return $this->notices[$index];
        else
            return "";
    }

    public function isAllowed($type)
    {
        $roles = $this->roles;
        return (in_array($type, $roles) || in_array("all", $roles));
    }

    public function setValue($value, $index = 0, $id_lang = null)
    {
        if (!is_null($id_lang)) {
            if (is_array($value)) {
                $this->values[$index][$id_lang] = $value;
            } else {
                $this->values[$index][$id_lang] = (is_null($value) ? '' : html_entity_decode($value, ENT_QUOTES, "UTF-8"));
            }
        } else {
            for ($i = 0; $i < count($this->values); $i++) {
                if (is_array($value)) {
                    $this->values[$index][$i] = $value;
                } else {
                    $this->values[$index][$i] = (is_null($value) ? '' : html_entity_decode($value, ENT_QUOTES, "UTF-8"));
                }
            }
        }
    }

    public function setNotice($notice, $index = 0)
    {
        $this->notices[$index] = $notice;
    }
}
