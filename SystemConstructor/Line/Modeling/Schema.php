<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 1/26/2020
 * Time: 12:02 PM
 */

namespace Absoft\Line\Modeling;

use Absoft\Line\Attributes\Hidden;
use Absoft\Line\Attributes\Varchar;
use Absoft\Line\Attributes\Primary;
use Absoft\Line\Attributes\Text;
use Absoft\Line\Attributes\Number;
use Absoft\Line\Attributes\Date;
use Absoft\Line\Attributes\Time;
use Absoft\Line\Attributes\Numeric;
use Absoft\Line\Attributes\Decimal;
use Absoft\Line\Attributes\TimeStamp;

class Schema{

    function string($name){
        return new Varchar($name);
    }

    function autoincrement($name){
        return new Primary($name);
    }

    function text($name){
        return new Text($name);
    }

    function int($name){
        return new Number($name);
    }

    function date($name){
        return new Date($name);
    }

    function time($name){
        return new Time($name);
    }

    function double($name){
        return new Numeric($name);
    }

    function float($name){
        return new Decimal($name);
    }

    function timestamp($name){
        return new TimeStamp($name);
    }

    function hidden($name){
        return new Hidden($name);
    }
}
