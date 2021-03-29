<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 5/18/2020
 * Time: 4:44 PM
 */

namespace Absoft\Line\Attributes;

class Updater
{

    public $_main_address;


    function __construct(){

        $this->_main_address = str_replace("\\", "\/", __DIR__."../../../");

    }

    function update($data){

        if(isset($data->folders) && $data->folders != null){

            $folders = (array) $data->folders;

            if(sizeof($folders) > 0){

                foreach($folders as $folder){

                    print "\n \t Creating folder named ".$folder->name;

                    if(mkdir($this->_main_address.$folder->FAddress)){

                        print "\n \t $folder->name created.";

                    }else{

                        print "\n \t failed to create $folder->name !!...";

                    }

                }

            }else{

                print "\n \t no folders to create.";

            }

        }
        else {

            print "\n no folders to create. this might be because of incorrect response from server!!";

        }

        if(isset($data->files) && $data->files != null){

            $files = (array) $data->files;

            if(sizeof($files) > 0){

                foreach($files as $file){

                    if(is_file($file->address)){

                        print "\n \t creating file named $file->name ...";

                        if(copy($file->address, $this->_main_address.$file->FAdress)){

                            print "\n \t file $file->name has created.";

                        }
                        else{

                            print "\n \t cannot create file $file->name!!!";

                        }

                    }

                }

            }
            else{

                print "\n \t no files to update or create!! this might be because of incorrect response from the server!!";

            }

        }
        else{

            print "\n \t no files to update or create!! this might be because of incorrect response from the server!!";

        }

    }

    function getInfo(){

        $json_address = str_replace("\\", "\/", __DIR__."../../../sys_description.json");

        $sys_description = json_decode(file_get_contents($json_address));

        $return["version"] = $sys_description->version;
        $return["type"] = $sys_description->framework_type;
        $return["update_address"] = $sys_description->framework_type;
        $return["update"] = "";

        return $return;

    }

    function start(){

        $info = $this->getInfo();

        $ch = curl_init($info->update_address);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $info);
        $response = curl_exec($ch);
        curl_close($ch);

        if($result_json = json_decode($response)){

            if($result_json->header->status == "success"){

                print "\n \t Update has started. Please don't close. if you close during update, your system might not work properly.";

                $this->update($result_json->data);

            }
            else{

                print "\n \t ".$result_json->header->message;

            }

        }
        else{

            print "\n \tincorrect update address or incorrect version";

        }

    }

}
