<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 1/21/2020
 * Time: 5:26 PM
 */

namespace Absoft\Line\Api;


use Absoft\App\Loaders\Loader;

class API implements MyInterface {


    function getAllData($api_key, $table)
    {

        $return = [
            "header" => [
                "provider" => "AbSoft",
                "data_permitted_to" => $api_key,
                "error" => "0",
                "error_message" => ""
            ],
            "data" => ""
        ];
        $return_json = "";
        $em = Loader::getModel($table);

        if($em != null){

            $result = $em->search(array());

            if($result['message'] == "1" || $result["message"] == "-3"){

                $return["data"] = $result['returned'];
                $return_json = json_encode($return);


            }else{

                $return["header"]["error"] = "1";
                $return["header"]["error_message"] = $result['returned'];
                $return_json = json_encode($return);

            }

        }
        else{

            $return["header"]["error"] = "1";
            $return["header"]["error_message"] = "there is no entity named $table";
            $return_json = json_encode($return);

        }

        return $return_json;

    }

    function getAllAttributes($api_key, $table, $condition, $relate){

        $return = [
            "header" => [
                "provider" => "AbSoft",
                "data_permitted_to" => $api_key,
                "error" => "0",
                "error_message" => ""
            ],
            "data" => ""
        ];
        $return_json = "";
        $em = Loader::getModel($table);

        if($em != null){

            $result = $em->search($condition);

            if($result["message"] == "1" || $result["message"] == "-3"){

                $data = $result['returned'];
                $pk = "id";

                if($relate != ""){

                    $join = Loader::getModel($relate);

                    if($join != null){

                        $ref = $join->getEntity()->getReference($table);
                        $ref2 = $em->getEntity()->getReference($relate);

                        /*
                         * if the following condition is true then the $table has many records in the table $relate
                         */
                        if($ref != ""){

                            foreach($data as $row){

                                $vl = $row[$pk];
                                $em->MAINS[$pk] = $vl;
                                $join_data = $join->hasMany($em);

                                if($join_data['message'] == "1" || $join_data['message'] == "-3"){

                                    $row[$relate] = $join_data["returned"];

                                }

                            }

                        }else if($ref2 != ""){

                            foreach($data as $row){

                                $vl = $row[$ref2];
                                $em->MAINS[$ref2] = $vl;
                                $join_data = $join->hasOne($em);

                                if($join_data['message'] == "1"){

                                    $row[$ref2] = $join_data["returned"];

                                }

                            }

                        }

                    }
                    else{

                        $return["header"]["error"] = "1";
                        $return["header"]["error_message"] = "there is no entity called $relate";

                    }

                }

                $return["data"] = $data;
                $return_json =  json_encode($return);

            }else{

                $return["header"]["error"] = "1";
                $return["header"]["error_message"] = $result['returned'];
                $return_json =  json_encode($return);
            }

        }
        else{

            $return["header"]["error"] = "1";
            $return["header"]["error_message"] = "there is no entity called $table";
            $return_json =  json_encode($return);

        }

        return $return_json;

    }

    function getAllRecords($api_key, $table, $filter, $relate)
    {

        $return = [
            "header" => [
                "provider" => "AbSoft",
                "data_permitted_to" => $api_key,
                "error" => "0",
                "error_message" => ""
            ],
            "data" => ""
        ];
        $return_json = "";
        $em = Loader::getModel($table);

        if($em != null){

            $result = $em->search(array(), $filter);

            if($result["message"] == "1" || $result["message"] == "-3"){

                $data = $result['returned'];
                $pk = "id";

                if($relate != ""){

                    $join = Loader::getModel($relate);

                    if($join != null){

                        $ref = $join->getEntity()->getReference($table);
                        $ref2 = $em->getEntity()->getReference($relate);

                        /*
                         * if the following condition is true then the $table has many records in the table $relate
                         */
                        if($ref != ""){

                            foreach($data as $row){

                                $vl = $row[$pk];
                                $em->MAINS[$pk] = $vl;
                                $join_data = $join->hasMany($em);

                                if($join_data['message'] == "1"){

                                    $row[$relate] = $join_data["returned"];

                                }

                            }

                        }else if($ref2 != ""){

                            foreach($data as $row){

                                $vl = $row[$ref2];
                                $em->MAINS[$ref2] = $vl;
                                $join_data = $join->hasOne($em);

                                if($join_data['message'] == "1"){

                                    $row[$ref2] = $join_data["returned"];

                                }

                            }

                        }

                    }
                    else{

                        $return["header"]["error"] = "1";
                        $return["header"]["error_message"] = "there is no entity called $relate";

                    }

                }

                $return["data"] = $data;
                $return_json =  json_encode($return);

            }else{

                $return["header"]["error"] = "1";
                $return["header"]["error_message"] = $result['returned'];
                $return_json =  json_encode($return);

            }

        }
        else{

            $return["header"]["error"] = "1";
            $return["header"]["error_message"] = "there is no entity called $table";
            $return_json =  json_encode($return);

        }

        return $return_json;

    }

    function getSpecified($api_key, $table, $condition, $filter, $relate)
    {

        $return = [
            "header" => [
                "provider" => "AbSoft",
                "data_permitted_to" => $api_key,
                "error" => "0",
                "error_message" => ""
            ],
            "data" => ""
        ];
        $return_json = "";
        $em = Loader::getModel($table);

        if($em != null){

            $result = $em->search($condition, $filter, $relate);

            if($result["message"] == "1" || $result["message"] == "-3"){

                $data = $result['returned'];

                $return["data"] = $data;
                $return_json = json_encode($return);

            }else{

                $return["header"]["error"] = "1";
                $return["header"]["error_message"] = $result["returned"];
                $return_json = json_encode($return);

            }

        }
        else{

            $return["header"]["error"] = "1";
            $return["header"]["error_message"] = "there is no entity called $table";
            $return_json = json_encode($return);


        }

        return $return_json;

    }

    /**
     * @param $api_key
     * @param $table
     * @param $values
     * @return false|string
     */
    function save($api_key, $table, $values)
    {
        $return = [
            "header" => [
                "provider" => "AbSoft",
                "data_permitted_to" => $api_key,
                "error" => "0",
                "error_message" => ""
            ],
            "data" => ""
        ];
        $return_json = "";
        $em = Loader::getModel($table);

        if($em != null){

            $result = $em->addRecord($values);

            if($result["message"] == "1" || $result["message"] == "-3"){

                $data = $result['returned'];
                $return["data"] = $data;
                $return_json = json_encode($return);

            }else{

                $return["header"]["error"] = "1";
                $return["header"]["error_message"] = $result['returned'][2];
                $return_json = json_encode($return);

            }

        }
        else{

            $return["header"]["error"] = "1";
            $return["header"]["error_message"] = "there is no entity named $table";
            $return_json = json_encode($return);

        }

        return $return_json;
    }

    function deleteRecord($api_key, $table, $condition){

        return "delete record called";
    }

    function updateRecord($api_key, $table, $set, $condition){

        return "update record called";
    }

    function testApiKey($api_key, $permission)
    {



    }

    function Specified($table, $condition, $filter){

        $em = Loader::getModel($table);
        $return = [];

        if($em != null){

            $result = $em->search($condition, $filter, "");

            $return = $result['returned'];

        }

        return $return;

    }

}
