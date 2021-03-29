<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 1/21/2020
 * Time: 5:23 PM
 */

namespace Absoft\Line\Api;

use Absoft\App\Loaders\Loader;

class Proxy1 implements MyInterface {

    public $subject;


    function __construct(){
        $this->subject = new API();
    }

    function start($table_name, $attributes, $pk = "", $pk_value = ""){

        if($table_name == null || $table_name == "" || $attributes == null){
            return [];
        }

        $att = (array) $attributes;
        $filter = [];
        $condition = [];

        $tbl = [];
        $atr = [];

        foreach($att as $name => $value){

            $filter[] = $name;

            if(is_object($value)){

                $atr[$name] = $value;
                $tbl[] = $name;

            }else if(!is_object($value) && $value != ""){

                $condition[$name] = $value;

            }

        }

        if($pk != ""){

            $condition[$pk] = $pk_value;
        }

        $return = $this->subject->Specified($table_name, $condition, $filter);


        foreach($return as $key => $value){

            foreach($tbl as $tb_name){

                $entity = Loader::getEntity($tb_name);
                $s_pk = $entity->getPrimaryAttribute();
                if($s_pk != null && is_string($s_pk)){

                    $return[$tb_name] = $this->start($tb_name, $atr[$tb_name], $s_pk, $return[$tb_name]);

                }

            }

        }

        return $return;

    }

    function request(Request $request){

        $return = "";
        $table = $request->table;

        if(sizeof($request->insert) == 0 && sizeof($request->set) == 0 && sizeof($request->delete) == 0){

            $condition = array();
            $filter = array();
            $relate = $request->join;

            if(sizeof($request->attributes) > 0){

                foreach($request->attributes as $key => $value){

                    $filter[] = $key;

                    if($value != ""){

                        $condition[$key] = ["value" =>$value, "equ" => "=", "det" => "and"];

                    }

                }

            }

            if(sizeof($filter) > 0 && sizeof($condition) > 0){

                $return = $this->getSpecified($request->key, $table, $condition, $filter, $relate);

            }else if(sizeof($filter) == 0 && sizeof($condition) > 0){

                $return = $this->getAllAttributes($request->key, $table, $condition, $relate);

            }else if(sizeof($filter) > 0 && sizeof($condition) == 0){

                $return = $this->getAllRecords($request->key, $table, $filter, $relate);

            }else if(sizeof($filter) == 0 && sizeof($condition) == 0){

                $return = $this->getAllData($request->key, $table);

            }

        }

        else if(sizeof($request->insert) == 0 && sizeof($request->set) == 0 && sizeof($request->delete) > 0){

            $return = $this->deleteRecord($request->key, $table, $request->delete);

        }
        else if(sizeof($request->insert) > 0 && sizeof($request->set) == 0 && sizeof($request->delete) == 0){

            $return = $this->save($request->key, $table, $request->insert);

        }
        else if(sizeof($request->insert) == 0 && sizeof($request->set) > 0 && sizeof($request->delete) == 0){

            $condition = array();

            if(sizeof($request->attributes) > 0){

                foreach($request->attributes as $key => $value){

                    if($value != ""){

                        $condition[$key] = ["value" => $value, "equ" => "=", "det" => "and"];

                    }

                }

            }

            $return = $this->updateRecord($request->key, $table, $request->set, $condition);
        }

        return $return;

    }

    function getAllData($api_key, $table)
    {
        return $this->subject->getAllData($api_key, $table);
    }

    function getAllAttributes($api_key, $table, $condition, $relate)
    {
        return $this->subject->getAllAttributes($api_key, $table, $condition, $relate);
    }

    function getAllRecords($api_key, $table, $filter, $relate)
    {
        return $this->subject->getAllRecords($api_key, $table, $filter, $relate);
    }

    function getSpecified($api_key, $table, $condition, $filter, $relate)
    {
        return $this->subject->getSpecified($api_key, $table, $condition, $filter, $relate);
    }

    function save($api_key, $table, $values)
    {
        return $this->subject->save($api_key, $table, $values);
    }

    function deleteRecord($api_key, $table, $condition)
    {
        return $this->subject->deleteRecord($api_key, $table, $condition);
    }

    function updateRecord($api_key, $table, $set, $condition)
    {
        return $this->subject->updateRecord($api_key, $table, $set, $condition);
    }

}
