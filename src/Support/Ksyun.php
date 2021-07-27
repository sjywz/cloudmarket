<?php
namespace Lzhy\Cloudmarket\Support;

use Lzhy\Cloudmarket\Tool\Aes;
use Lzhy\Cloudmarket\Tool\Unify;

class Ksyun extends Cloud
{
    protected $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function input($parse = false)
    {
        $input = array_merge($_GET,$_POST);
        if($parse){
            $input = $this->parseInput($input);
        }

        return $input;
    }

    public function parseInput($input)
    {
        if(isset($input['extendParams']) && $input['extendParams']){
            try{
                $extendArr = json_decode($input['extendParams'],true);
                foreach($extendArr as $k => $v){
                    $extendArr[$k] = Aes::decrypt($v,$this->token);
                }
                $input['extendParams'] = json_encode($extendArr);
            }catch(\Exception $e){

            }
        }
        $input = Unify::tranform($input);
        return $input;
    }

    public function response($data)
    {
        if(isset($data['appInfo']) && $data['appInfo']){
            $appInfo = $data['appInfo'];
            $username = Aes::encrypt($appInfo['userName'],$this->token);
            $password = Aes::encrypt($appInfo['password'],$this->token);
            $data['appInfo']['userName'] = $username;
            $data['appInfo']['password'] = $password;
        }
        exit(json_encode($data));
    }

    public function checkSign()
    {
        $param = $this->input();
        if(empty($param['signature'])){
            return false;
        }

        $signature = $param['signature'];
        unset($param['signature']);
        ksort($param);
        if(isset($param['extendParams']) && !empty($param['extendParams'])){
            $param['extendParams'] = urlencode($param['extendParams']);
        }
        if(isset($param['productInfo']) && !empty($param['productInfo'])){
            $param['productInfo'] = urlencode($param['productInfo']);
        }
        if(isset($param['extraBillItems']) && !empty($param['extraBillItems'])){
            $param['extraBillItems'] = urlencode($param['extraBillItems']);
        }

        $content = urldecode(http_build_query($param));
        $hash = hash_hmac('sha256',$content,$this->token);
        return $hash == $signature;
    }
}