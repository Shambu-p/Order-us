<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 2/26/2020
 * Time: 8:10 PM
 */

namespace Absoft\Line\Attributes;

class TimeStamp extends Attribute{

    public $length = 0;
    public $nullable = true;
    public $type = "timestamp";
    public $auto_increment = false;
    public $unique = false;

    function __construct($name){
        $this->name = $name;
    }

    function Reference($table_name)
    {
        $this->foreign = $table_name;
        return $this;
    }

    function getReference()
    {
        return $this->foreign;
    }

    function on($attribute_name)
    {
        $this->reference = $attribute_name;
        return $this;
    }

    function getAttribute()
    {
        return $this->reference;
    }

    function getLength()
    {
        return 0;
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
        $this->key = "primary key";
        return $this;
    }

    function unique($value)
    {
        // TODO: Implement unique() method.

        return $this;

    }

}
