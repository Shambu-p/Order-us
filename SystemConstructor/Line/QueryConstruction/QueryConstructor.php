<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 1/18/2020
 * Time: 9:42 PM
 */

namespace Absoft\Line\QueryConstruction;

abstract class QueryConstructor{
    public $query;
    public $values;

    abstract function getQuery();

    abstract function getValues();

    function singleDerdari(array $arr){
        $return = "";

        //implode(",", $arr);

        for($i = 0; $i < sizeof($arr); $i ++){
            if($i == 0){
                $return = $return.$arr[$i];
            }else{
                $return = $return.", ".$arr[$i];
            }
        }

        return $return;
    }

    /**
     * @param array $arr
     * @param $placeholder
     * @return array
     */
    function setDerdari($arr, $placeholder){

        $return = array();
        $array = array();
        $query = "";

        $count = 0;

        foreach($arr as $key => $value){

            if($count == 0){

                $query = $query.$key." = :".$placeholder."_".$key;

            }else{

                $query = $query.", ".$key." = :".$placeholder."_".$key;

            }

            $array[$placeholder."_".$key] = $value;
            $count += 1;

        }

        $return['query'] = $query;
        $return['values'] = $array;

        return $return;
    }

    function conditionDerdari(array $arr){

        $return = "";
        $count = 0;

        foreach($arr as $value){

            if($count == 0){

                $return .= $value['name']." ". $value['equ'] ." :condition_".$value['name'];

            }else{

                if($value['det'] == "and" || $value['det'] == "or"){

                    $return .= " ". $value['det'] ." ".$value['name']." ". $value['equ'] ." :condition_".$value['name'];

                }else{

                    $return .= " and ".$value['name']." ". $value['equ'] ." :condition_".$value['name'];

                }

            }

            $count += 1;

        }

        return $return;
    }

}
