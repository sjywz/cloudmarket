<?php
namespace Lzhy\Cloudmarket\Support;

abstract class Cloud
{
    abstract function input($prase = false);
    abstract function unify($unify = true);
    abstract function response($data);
    abstract function checkSign();
}