<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 1/25/2020
 * Time: 2:53 PM
 */

namespace Absoft\Line\Attributes;

class Primary extends Attribute
{

    public $auto_increment = true;
    public $type = "int";
    public $nullable = false;
    public $length = 11;
    public $key = "primary key";
    public $sign = false;
    public $unique = false;

    function __construct($name){

        $this->name = $name;

    }

    function Reference($table_name)
    {
        return $this;
    }

    function getReference()
    {
        return $this->foreign;
    }

    function on($attribute_name)
    {
        return $this;
    }

    function getAttribute()
    {
        return $this->reference;
    }

    function getLength()
    {
        return $this->length;
    }

    function length($length)
    {
        $this->length = $length;
        return $this;
    }

    function nullable($boolean)
    {
        $this->nullable = $boolean;
        return $this;
    }

    function getNullable()
    {
        return $this->nullable;
    }

    function getName()
    {
        return $this->name;
    }

    function sign($boolean){

        $this->sign = $boolean;
        return $this;

    }

    function auto_increment($boolean)
    {
        $this->auto_increment = $boolean;
        return $this;
    }

    function setPrimaryKey()
    {
        return $this;
    }

    function unique($value)
    {
        // TODO: Implement unique() method.

        $this->unique = $value;
        return $this;

    }

}
