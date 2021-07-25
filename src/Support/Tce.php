<?php
namespace Lzhy\Cloudmarket\Support;

class Tce extends Cloud
{
    protected $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function input($parse = false)
    {
        $rawInput = file_get_contents('php://input');
        $input = json_decode($rawInput,true);
        if(!is_array($input)){
            $input = json_decode($input,true);
        }
        if($input){
            $input = array_merge($_GET,$input);
        }
        if($parse){
            $input = $this->parseInput($input);
        }

        return $input;
    }

    public function parseInput($input)
    {
        return $input;
    }

    public function response($data)
    {
        return $data;
    }

    public function checkSign()
    {
        $param = $this->input();

        $signature = $param['signature'];
        $timestamp = $param['timestamp'];
        $eventId = $param['eventId'];

        $currentTimestamp = time();
        if($currentTimestamp - $timestamp > 30){
            // return false;
        }

        $timestamp = (string)$timestamp;
        $eventId = (string)$eventId;
        $params = array($this->token, $timestamp, $eventId);
        sort($params, SORT_STRING);
        $str = implode('', $params);
        $requestSignature = hash('sha256', $str);
        return $signature === $requestSignature;
    }
}