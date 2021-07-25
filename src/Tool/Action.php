<?php
namespace Lzhy\Cloudmarket\Tool;

class Action
{
    public static function unify($type)
    {
        $jsaction = [];
    }

    public function baidu()
    {
        //action
        $actions = [
            'createInstance', //新购
            'renewInstance', //续费
            'expireInstance', //过期
            'releaseInstance', //释放
            'getInstanceDeliveryInfo', //获取资源交付信息
            'preCheckParams', //参数预检查接口
        ];
    }

    public function huawingaction()
    {
        //activity
        $actions = [
            'newInstance', //新购
            'refreshInstance', //续费
            'expireInstance', //过期
            'releaseInstance',//释放
            'upgrade'//升级
        ];
    }

    public function ksyun()
    {
        //action
        $actions = [
            'createInstance', //新购
            'renewInstance', //续费
            'upgradeInstance', // 升级
            'shutdownInstance', //冻结
            'releaseInstance', //回收
            'verify', //免登陆
        ];
    }


    public function jdaction()
    {
        //action
        $actions = [
            'createInstance', //新购
            'renewInstance', //续费
            'upgradeInstance', //升级
            'dilateInstance', //扩容
            'releaseInstance', //释放
            'verify' //免登
        ];
    }

    public function tencentAtion()
    {
        //action
        $actions = [
            'verifyInterface', //效验
            'createInstance', //创建
            'renewInstance', //续费
            'modifyInstance', //变更
            'expireInstance', //过期
            'destroyInstance', //销毁
            'flowQuery', //计量商品计量信息查询接口
        ];
    }
}