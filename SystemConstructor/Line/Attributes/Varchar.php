<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 1/25/2020
 * Time: 2:42 PM
 */

namespace Absoft\Line\Attributes;

class Varchar extends Attribute
{

    public $length = 30;
    public $nullable = true;
    public $type = "varchar";
    public $auto_increment = false;
    public $unique = false;


    function __construct($name){
        $this->name = $name;
    }

    /**
     * @param $table_name
     * @return $this
     */


    function Reference($table_name)
    {
        $this->key = "foreign key";
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

        $this->unique = $value;
        return $this;

    }

}
