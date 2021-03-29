<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 5/24/2020
 * Time: 3:39 PM
 */

namespace Absoft\App\Pager;

use Absoft\App\Routing\Route;

class Pager
{

    function create($header, $route_name, $name, $page_size, $requests = []){

        $_SESSION["pager"][$name]["headers"] = $header;
        $_SESSION["pager"][$name]["page_size"] = $page_size;
        $_SESSION["pager"][$name]["current_page"] = 1;
        $_SESSION["pager"][$name]["max_size"] = 1;
        $_SESSION["pager"][$name]["link_class"] = "";
        $_SESSION["pager"][$name]["current_class"] = "";
        $_SESSION["pager"][$name]["route_name"] = $route_name;
        $_SESSION["pager"][$name]["requests"] = $requests;


    }



    public static function currentPageClass($name, $class_name){

        $_SESSION["pager"][$name]["current_class"] = $class_name;

    }

    public static function linkPageClass($name, $class_name){

        $_SESSION["pager"][$name]["link_class"] = $class_name;

    }

    public static function getPage($data, $name, $page_number){

        if(isset($_SESSION["pager"][$name])){

            if(isset($_SESSION["pager"][$name]["headers"])){

                if(isset($_SESSION["pager"][$name]["page_size"])){

                    if(sizeof($data) > 0){

                        $data_size = sizeof($data);
                        $page_size = $_SESSION["pager"][$name]["page_size"];
                        $last_page = Pager::maxPageNumber($data_size, $page_size);
                        $_SESSION["pager"][$name]["max_size"] = $last_page;
                        $_SESSION["pager"][$name]["current_page"] = $page_number;

                        if($page_number <= $last_page){

                            $return = [];
                            $first_index = ($page_number-1)*$page_size;
                            $last_index = $page_size*$page_number;

                            while($first_index < $last_index && isset($data[$first_index])){

                                $return["data"][] = $data[$first_index];
                                $first_index += 1;

                            }

                            return Route::display($_SESSION["pager"][$name]["headers"]->page_name, $_SESSION["pager"][$name]["headers"]->sub_page, $return);

                        }else{

                            return Route::display($_SESSION["pager"][$name]["headers"]->page_name, $_SESSION["pager"][$name]["headers"]->sub_page);

                        }


                    }else{

                        return Route::display($_SESSION["pager"][$name]["headers"]->page_name, $_SESSION["pager"][$name]["headers"]->sub_page);

                    }

                }else{

                    return Route::display($_SESSION["pager"][$name]["headers"]->page_name, $_SESSION["pager"][$name]["headers"]->sub_page);

                }

            }else{

                return Route::display($_SESSION["pager"][$name]["headers"]->page_name, $_SESSION["pager"][$name]["headers"]->sub_page);

            }

        }

        return Route::display($_SESSION["pager"][$name]["headers"]->page_name, $_SESSION["pager"][$name]["headers"]->sub_page);

    }

    public static function pageData($data, $name, $page_number){

        if(isset($_SESSION["pager"][$name])){

            if(isset($_SESSION["pager"][$name]["headers"])){

                if(isset($_SESSION["pager"][$name]["page_size"])){

                    if(sizeof($data) > 0){

                        $data_size = sizeof($data);
                        $page_size = $_SESSION["pager"][$name]["page_size"];
                        $last_page = Pager::maxPageNumber($data_size, $page_size);
                        $_SESSION["pager"][$name]["max_size"] = $last_page;
                        $_SESSION["pager"][$name]["current_page"] = $page_number;

                        if($page_number <= $last_page){

                            $return = [];
                            $first_index = ($page_number-1)*$page_size;
                            $last_index = $page_size*$page_number;

                            while($first_index < $last_index && isset($data[$first_index])){

                                $return[] = $data[$first_index];
                                $first_index += 1;

                            }

                            return $return;

                        }else{

                            return [];

                        }


                    }else{

                        return [];

                    }

                }else{

                    return [];

                }

            }else{

                return [];

            }

        }

        return [];

    }

    public static function maxPageNumber($row_count, $page_size){

        $last_page = 0;
        while($row_count >= $page_size){

            $row_count -= $page_size;
            $last_page += 1;

        }

        if($row_count > 0){

            $last_page += 1;

        }

        return $last_page;

    }

    public static function routeName($pager_name, $route_name){

        $_SESSION["pager"][$pager_name]["route_name"] = $route_name;

    }

    public static function pagerView($name){

        $reqs = $_SESSION["pager"][$name]["requests"];
        $reqs["page_number"] = "";

        if($_SESSION["pager"][$name]["current_page"] > 1){

            $reqs["page_number"] = 1;
            print '<a href="'.Route::goRouteAddress($_SESSION["pager"][$name]["route_name"], $reqs).'" type="button" class="'.$_SESSION["pager"][$name]["link_class"].'">First</a>';

            $reqs["page_number"] = $_SESSION["pager"][$name]["current_page"] - 1;
            print '<a href="'.Route::goRouteAddress($_SESSION["pager"][$name]["route_name"], $reqs).'" type="button" class="'.$_SESSION["pager"][$name]["link_class"].'"> < </a>';

        }

        for($i = 1; $i <= $_SESSION["pager"][$name]["max_size"]; $i++){

            if($_SESSION["pager"][$name]["current_page"] == $i){

                $reqs["page_number"] = 1;
                print '<button class="'.$_SESSION["pager"][$name]["current_class"].'">'.$_SESSION["pager"][$name]["current_page"].'</button>';

            }else{

                $reqs["page_number"] = $i;
                print '<a href="'.Route::goRouteAddress($_SESSION["pager"][$name]["route_name"], $reqs).'" class="'.$_SESSION["pager"][$name]["link_class"].'">'.$i.'</a>';

            }

        }

        if($_SESSION["pager"][$name]["current_page"] < $_SESSION["pager"][$name]["max_size"]){

            $reqs["page_number"] = $_SESSION["pager"][$name]["current_page"] + 1;
            print '<a href="'.Route::goRouteAddress($_SESSION["pager"][$name]["route_name"], $reqs).'" class="'.$_SESSION["pager"][$name]["link_class"].'"> > </a>';

            $reqs["page_number"] = $_SESSION["pager"][$name]["max_size"];
            print '<a href="'.Route::goRouteAddress($_SESSION["pager"][$name]["route_name"], $reqs).'" class="'.$_SESSION["pager"][$name]["link_class"].'">Last</a>';

        }

    }

    public static function routeRequest($name, $request){

        $_SESSION["pager"][$name]["requests"] = $request;

    }

    public static function getPageNumber($name){

        return $_SESSION["pager"][$name]["current_page"];

    }

    public static function getLastPageNumber($name){

        return $_SESSION["pager"][$name]["max_size"];

    }

    public static function check($name){

        if(isset($_SESSION["pager"][$name])){
            return true;
        }
        return false;

    }

    public static function tellTime($period){

        $now = $period;
        $days = 0;
        $month = 0;
        $year = 0;
        $minute = 0;
        $seconds = 0;
        $hour = 0;
        //3600 * 24 86400

        if($now > 60){

            while($now > 60){

                $now = $now - 60;
                $minute += 1;

            }

            if($minute > 60){

                $now = $minute;

                while($now > 60){

                    $now = $now - 60;
                    $hour += 1;

                }

                if($hour > 24){

                    $now = $hour;

                    while($now > 24){

                        $now = $now - 24;
                        $days += 1;

                    }

                    if($days > 30){

                        $now = $days;

                        while($now > 30){

                            $now = $now - 30;
                            $month += 1;

                        }

                        if($month > 12){

                            $now = $month;

                            while($now > 12){

                                $now = $now - 12;
                                $year += 1;

                            }

                            if($year == 1){

                                return ["unit" => "year", "length" => $year];

                            }
                            else{

                                return ["unit" => "years", "length" => $year];

                            }


                        }else{

                            return ["unit" => "month", "length" => $month];

                        }

                    }
                    else{

                        if($days == 1){

                            return ["unit" => "day", "length" => $days];

                        }
                        else{

                            return ["unit" => "days", "length" => $days];

                        }

                    }

                }
                else{

                    if($hour == 1){

                        return ["unit" => "hour", "length" => $hour];

                    }
                    else{

                        return ["unit" => "hours", "length" => $hour];

                    }

                }

            }
            else{

                if($minute == 1){

                    return ["unit" => "minute", "length" => $minute];

                }
                else{

                    return ["unit" => "minutes", "length" => $minute];

                }

            }

        }else{

            if($seconds == 1){

                return ["unit" => "second", "length" => $seconds];

            }
            else{

                return ["unit" => "seconds", "length" => $seconds];

            }

        }


    }

    public static function limiter($text, $limit){

        if(sizeof($text) > $limit){

            return substr($text, 0, $limit)."...";

        }
        else{

            return $text;

        }

    }

}
