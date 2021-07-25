<?php
namespace Lzhy\Cloudmarket\Support;

use Lzhy\Cloudmarket\Traits\Hce as TraitsHce;

class Hce extends Cloud
{
    use TraitsHce;

    protected $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function input($parse = false)
    {
        $input = array_merge($_GET,$_POST);
        $input = self::pddParam($input);
        if($parse){
            $input = $this->pddParam($input);
        }
        return $input;
    }

    public function parseInput($input)
    {
        if(isset($input['email']) && $input['email']){
            $input['email'] = $this->decrypt($input['email'],$this->token);
        }
        if(isset($input['mobilePhone']) && $input['mobilePhone']){
            $input['mobilePhone'] = $this->decrypt($input['mobilePhone'],$this->token);
        }
        $input['action'] = $input['activity'];

        return $input;
    }

    public function response($data)
    {
        if(isset($data['appInfo']) && $data['appInfo']){
            $appInfo = $data['appInfo'];
            $username = $this->encrypt($appInfo['userName'],$this->token);
            $password = $this->encrypt($appInfo['password'],$this->token);
            $data['appInfo'] = [
                'userName' => $username,
                'password' => $password
            ];
        }

        return $data;
    }

    public function action()
    {
        $actions = [
            'newInstance',
        ];
    }

    public function checkSign()
    {
        $param = $this->input();
        $authToken = $param['authToken'];
        unset($param['authToken']);
        ksort($param);
        $timeStamp = $param['timeStamp'];
        $content = urldecode(http_build_query($param));
        $hash = hash_hmac('sha256',$content,$this->token.$timeStamp,true);

        return base64_encode($hash) === $authToken;
    }
}