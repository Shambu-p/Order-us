<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 10/24/2019
 * Time: 6:41 PM
 */

namespace Absoft\Line\Attributes;

abstract class Attribute{

    public $name = null;
    public $key = null;
    public $reference = null;
    public $foreign = null;
    public $type = null;
    public $length = null;
    public $nullable = null;
    public $auto_increment = null;
    public $sign = null;
    public $unique = null;

    abstract function getName();

    abstract function Reference($table_name);

    abstract function getReference();

    abstract function on($attribute_name);

    abstract function getAttribute();

    abstract function getLength();

    abstract function length($length);

    abstract function nullable($boolean);

    abstract function getNullable();

    abstract function sign($boolean);

    abstract function auto_increment($boolean);

    abstract function setPrimaryKey();

    abstract function unique($value);

}
