<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 1/21/2020
 * Time: 5:19 PM
 */

namespace Absoft\Line\Api;

interface MyInterface{

    function getAllData($api_key, $table);

    function getAllAttributes($api_key, $table, $condition, $relate);

    function getAllRecords($api_key, $table, $filter, $relate);

    function getSpecified($api_key, $table, $condition, $filter, $relate);

    function save($api_key, $table, $values);

    function deleteRecord($api_key, $table, $condition);

    function updateRecord($api_key, $table, $set, $condition);

}
