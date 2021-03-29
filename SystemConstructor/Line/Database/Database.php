<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 3/2/2020
 * Time: 3:04 PM
 */

namespace Absoft\Line\Database;

use Absoft\Line\QueryConstruction\QueryConstructor;
use Absoft\Line\QueryConstruction\Selection;
use Absoft\Line\QueryConstruction\Update;

class Database extends Connection {

    public $subject = null;
    public $configuration_array = null;


    function __construct($srv_name, $db_name){

        $json = null;
        $db = null;

        if($json = file_get_contents(str_replace("\\", "/", __DIR__)."/Database.json")){

            $this->configuration_array = (array) json_decode($json, true);

        }

        if(sizeof($this->configuration_array) > 0){

            if(isset($this->configuration_array[$srv_name][$db_name])){

                if($srv_name == "MySql"){

                    $this->subject = new MySql($this->configuration_array[$srv_name][$db_name]);

                }
                else if($srv_name == "MsSql"){

                    $this->subject = new MsSql($this->configuration_array[$srv_name][$db_name]);

                }

            }

        }

    }

    function getConnection()
    {
        return $this->subject->getConnection();
    }

    function execute(QueryConstructor $query)
    {
        return $this->subject->execute($query);
    }

    function executeUpdate(Update $query)
    {
        return $this->subject->executeUpdate($query);
    }

    function executeFetch(Selection $query)
    {
        return $this->subject->executeFetch($query);
    }

}
