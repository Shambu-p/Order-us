<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 11/1/2020
 * Time: 10:31 AM
 */

namespace Absoft\Line\Attributes;



class Hidden extends Attribute
{

    public $length = 100;
    public $nullable = true;
    public $type = "text";
    public $auto_increment = false;
    public $unique = false;

    function __construct($name){
        $this->name = $name;
        return $this;
    }

    function Reference($table_name)
    {
        //$this->foreign = $table_name;
        return $this;
    }

    function getReference()
    {
        return $this->foreign;
    }

    function on($attribute_name)
    {
        //$this->reference = $attribute_name;
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

        return $this;

    }

    function auto_increment($boolean){

        return $this;
    }

    function setPrimaryKey()
    {
        return $this;
    }

    function unique($value)
    {
        // TODO: Implement unique() method.

        return $this;

    }
}
