<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 1/18/2020
 * Time: 10:58 PM
 */

namespace Absoft\Line\Database;


use Absoft\Line\QueryConstruction\QueryConstructor;
use Absoft\Line\QueryConstruction\Selection;
use Absoft\Line\QueryConstruction\Update;

abstract class Connection{

    abstract function getConnection();

    abstract function execute(QueryConstructor $query);

    abstract function executeUpdate(Update $query);

    abstract function executeFetch(Selection $query);

}
