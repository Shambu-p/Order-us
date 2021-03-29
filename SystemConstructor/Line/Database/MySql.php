<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 12/7/2019
 * Time: 9:15 AM
 */

namespace Absoft\Line\Database;

use Absoft\App\Security\IpCheck;
use Absoft\Line\QueryConstruction\QueryConstructor;
use Absoft\Line\QueryConstruction\Selection;
use Absoft\Line\QueryConstruction\Update;

class MySql extends Connection {

    public $HOST_ADDRESS = null;
    public $DB_NAME = null;
    private $DB_USERNAME = null;
    private $DB_PASSWORD = null;

    function __construct(array $db_info){

        $this->HOST_ADDRESS = $db_info['HOST_ADDRESS'];
        $this->DB_NAME = $db_info['DB_NAME'];
        $this->DB_USERNAME = $db_info['DB_USERNAME'];
        $this->DB_PASSWORD = $db_info['DB_PASSWORD'];

    }

    /**
     * @return \PDO|null
     */
    function getConnection(){

        try{

            $dns = "mysql:host=". $this->HOST_ADDRESS.";dbname=".$this->DB_NAME;

            $connection = new \PDO($dns, $this->DB_USERNAME, $this->DB_PASSWORD);
            //$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $connection;

        }catch(\Exception $e){

            /**

            $return['message'] = "0";
            $return['returned'] = $e->getMessage();
             *
             * No connection could be made because the target machine actively refused it.
             */

            \ErrorHandler::reportError(
                "Database Connection Failed!",
                "tried to connect mysql Database server <br> location: $this->HOST_ADDRESS<br> to database named: $this->DB_NAME <br>".$e->getMessage(),
                __FILE__." on Line ".__LINE__,
                "immediate"
            );

            return null;

        }

    }

    /**
     * @param Selection $query
     * @return null
     * @return array
     */
    function executeFetch(Selection $query){

        $return = [];

        try{

            $data = array();
            $db = $this->getConnection();
            $status = null;
            $statement = null;
            $count = 0;

            if($db){

                $statement = $db->prepare($query->getQuery());

                if(sizeof($query->getValues()) == 0){

                    $status = $statement->execute();

                }else{

                    $status = $statement->execute($query->getValues());

                }

                if($status){

                    while($row = $statement->fetch( \PDO:: FETCH_ASSOC)){

                        $data[] = $row;
                        $count += 1;

                    }

                    if($count > 0){

                        $return['returned'] = $data;
                        $return['message'] = "1";

                    }else{

                        $return['returned'] = $data;
                        $return['message'] = "-3";

                    }

                }else{

                    $return['message'] = "0";
                    $return['returned'] = $statement->errorInfo()[2];

                    $this->generateLog($query->getQuery(), IpCheck::clientIp(), IpCheck::clientIp());

                    \ErrorHandler::reportError(
                        "Query Execution Failed!",
                        $statement->errorInfo()[2],
                        str_replace("\\", "\//",  __FILE__." on Line ".__LINE__),
                        "immediate"
                    );

                }

            }
            else{

                $return['message'] = "-1";
                $return['returned'] = "no connection made!";

            }

        }catch (\Exception $e){

            $return['message'] = "-2";
            $return['returned'] = $e->getMessage();

            \ErrorHandler::reportError(
                "Connection Exception Occurred!",
                $e->getMessage(),
                str_replace("\\", "\//",  __FILE__." on Line ".__LINE__)
            );

        }

        return $return;
    }

    /**
     * @param Update $sql
     * @return null
     */
    function executeUpdate(Update $sql){

        $return = [];

        try{

            $db = $this->getConnection();
            $status = null;
            $statement = null;

            if($db){

                //$db = $result['returned'];
                $statement = $db->prepare($sql->getQuery());

                if(sizeof($sql->getValues()) == 0){

                    $status = $statement->execute();

                }else{

                    $status = $statement->execute($sql->getValues());

                }

                if($status){

                    $return['message'] = "1";
                    $return['returned'] = $statement;

                }else{

                    $this->generateLog($sql->getQuery(), "localhost", "localhost");
                    $return['message'] = "0";
                    $return['returned'] = ($statement->errorInfo())[2];

                    \ErrorHandler::reportError(
                        "Query Execution Failed!",
                        $statement->errorInfo()[2],
                        str_replace("\\", "\//",  __FILE__." on Line ".__LINE__),
                        "Immediate"
                    );

                }

            }else{

                $return['message'] = "-1";
                $return['returned'] = "No Connection were made!";

            }

        }catch (\Exception $e) {

            $return['message'] = "-2";
            $return['returned'] = $e->getMessage();

            \ErrorHandler::reportError("Execution Exception Occurred!", $e->getMessage(), str_replace("\\", "\//",  __FILE__." on Line ".__LINE__), "immediate");

        }

        return $return;

    }

    /**
     * @param $sql
     * @return array
     */
    function execute(QueryConstructor $sql){

        $return = [];
        $db = $this->getConnection();
        //$db = $connection["returned"];
        $status = null;
        $statement = null;

        if($db){

            $statement = $db->prepare($sql->getQuery());

            if(sizeof($sql->getValues()) == 0){

                $status = $statement->execute();

            }else{

                $status = $statement->execute($sql->getValues());

            }

            if($status){

                $return["message"] = "1";
                $return["returned"] = $status;

            }else{

                $return["message"] = "0";
                $return["returned"] = $statement->errorInfo()[2];

                \ErrorHandler::reportError(
                    "Query Execution Failed!",
                    $statement->errorInfo()[2],
                    str_replace("\\", "\//",  __FILE__." on Line ".__LINE__),
                    "immediate"
                );

                //die("error");

            }

        }
        else{

            $return["message"] = "-1";
            $return["returned"] = "No Connection were made!";;

        }

        return $return;

    }

    function generateLog($sql, $srvname, $ip){

        try{

            $nd = new \DateTime();
            $time = $nd->format("H:i:s");
            $date = $nd->format("Y-m-j");
            $log = "$ip, $srvname, $sql, $time, $date \n";
            file_put_contents("../failure_log.txt", $log, FILE_APPEND);
            return 1;

        }catch(\Exception $e){

            return $e->getMessage();

        }

    }

}
