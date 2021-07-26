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
            default:
                throw new \Exception('current market is not support');
        }
    }

    public function input($parse = true)
    {
        if(empty($parse)){
            return $this->cloudmarket->input();
        }
        return $this->cloudmarket->parseInput($this->cloudmarket->input());
    }

    public function response($data)
    {
        return $this->cloudmarket->response($data);
    }

    public function checkSign()
    {
        return $this->cloudmarket->checkSign();
    }

    public function parseInput($input)
    {
        return $this->cloudmarket->parseInput($input);
    }
}