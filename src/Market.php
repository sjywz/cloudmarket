<?php

namespace Lzhy\Cloudmarket;

use Lzhy\Cloudmarket\Support\Cloud;

class Market
{
    protected $cloudmarket;

    public function __construct(Cloud $cloudmarket)
    {
        $this->cloudmarket = $cloudmarket;
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