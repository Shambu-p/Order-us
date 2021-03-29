<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 10/31/2020
 * Time: 1:12 PM
 */

namespace Absoft\App\Loaders;


class Resource
{

    public static function imageAddress($image_name){

        $type = pathinfo($image_name)["extension"];
        //$handle = @fopen($_SESSION["_system"]["_main_url"]."resource/images/$image_name", "rb");
        $content = file_get_contents($_SESSION["_system"]["_main_url"]."resource/images/$image_name");
        $content = base64_encode($content);

        return "data:image/$type;base64,".''.$content.'';

    }

    public static function loadAudio($address){

        $type = pathinfo($address)["extension"];
        $handle = @fopen($_SESSION["_system"]["_main_url"]."resource/audios/$address", "rb");
        $content = file_get_contents($_SESSION["_system"]["_main_url"]."resource/audios/$address");
        $content = base64_encode($content);

        return "data:audio/$type;base64,".''.$content.'';

    }

    public static function loadVideo($address){

        $type = pathinfo($address)["extension"];
        $handle = @fopen($_SESSION["_system"]["_main_url"]."resource/videos/$address", "rb");
        $content = file_get_contents($_SESSION["_system"]["_main_url"]."resource/videos/$address");
        $content = base64_encode($content);

        return "data:video/$type;base64,".''.$content.'';

    }

    public static function loadDocuments($address){

        $type = pathinfo($address)["extension"];
        //$handle = @fopen($_SESSION["_system"]["_main_url"]."resource/documents/$address", "rb");
        $content = file_get_contents($_SESSION["_system"]["_main_url"]."resource/documents/$address");
        $content = base64_encode($content);

        return "data:application/$type;base64,".''.$content.'';

    }

}
