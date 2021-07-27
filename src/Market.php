<?php

namespace Lzhy\Cloudmarket;

use Lzhy\Cloudmarket\Support\Bce;
use Lzhy\Cloudmarket\Support\Hce;
use Lzhy\Cloudmarket\Support\Jd;
use Lzhy\Cloudmarket\Support\Ksyun;
use Lzhy\Cloudmarket\Support\Tce;

class Market
{
    protected $cloudmarket;
    protected $supportMarket = ['bce','ksyun','hce','jd','tce'];

    /**
     * @param string $market 市场标识
     * @param string $token token/key/秘钥
     */
    function __construct($market,$token)
    {
        if(empty($market) || empty($token)){
            throw new \Exception('market or token is required');
        }
        $market = strtolower($market);
        if(!in_array($market,$this->supportMarket)){
            throw new \Exception('current market is not support');
        }

        switch($market){
            case 'bce':
                $this->cloudmarket = new Bce($token);
                break;
            case 'ksyun':
                $this->cloudmarket = new Ksyun($token);
                break;
            case 'hce':
                $this->cloudmarket = new Hce($token);
                break;
            case 'jd':
                $this->cloudmarket = new Jd($token);
                break;
            case 'tce':
                $this->cloudmarket = new Tce($token);
                break;
            default:
                throw new \Exception('current market is not support');
        }
    }

    /**
     * 获取输入
     * @param boolean $unify 统一参数
     * @return array
     */
    public function input($unify = true)
    {
        $input = $this->cloudmarket->input(true);
        if(empty($unify)){
            return $input;
        }
        return $this->cloudmarket->parseInput($input,$unify);
    }

    /**
     * 包装响应
     * @param array $data
     * @return void
     */
    public function response($data)
    {
        return $this->cloudmarket->response($data);
    }

    /**
     * 检测签名
     * @return void
     */
    public function checkSign()
    {
        return $this->cloudmarket->checkSign();
    }

    public function parseInput($input)
    {
        return $this->cloudmarket->parseInput($input);
    }
}