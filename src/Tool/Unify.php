<?php
namespace Lzhy\Cloudmarket\Tool;

class Unify
{
    public static function tranform($input)
    {
        try{
            if(isset($input['activity']) && $input['activity']){
                $switchActivity = [
                    'newInstance' => 'createInstance',
                    'refreshInstance' => 'renewInstance',
                ];
                if(isset($switchActivity[$input['activity']])){
                    $input['action'] = $switchActivity[$input['activity']];
                }else{
                    $input['action'] = $input['activity'];
                }
            }
            if($input['action'] == 'destroyInstance'){
                $input['action'] = 'releaseInstance';
                $input['action_raw'] = 'destroyInstance';
            }

            $input = self::_createInputUtify($input);
            return $input;
        }catch(\Exception $e){
            return $input;
        }
    }

    private static function _createInputUtify($input)
    {
        if(isset($input['orderNumber'])){
            $input['orderId'] = $input['orderNumber'];
        }
        if(isset($input['jdPin'])){
            $input['userId'] = $input['jdPin'];
        }
        if(isset($input['accountId'])){
            $input['userId'] = $input['jdPin'];
        }
        if(isset($input['serviceCode'])){
            $input['productId'] = $input['serviceCode'];
        }
        //规格
        if(isset($input['skuId'])){
            $input['skuCode'] = $input['skuId'];
        }
        if(isset($input['packageCode'])){
            $input['skuCode'] = $input['packageCode'];
        }
        if(isset($input['periodId'])){
            $input['skuCode'] = $input['periodId'];
        }
        //过期时间
        if(isset($input['expireTime'])){
            $input['expireTime_raw'] = $input['expireTime'];
            $input['expireTime'] = strtotime($input['expireTime']);
        }
        if(isset($input['serviceEndTime'])){
            $input['expireTime'] = strtotime($input['serviceEndTime']);
        }
        if(isset($input['expiredOn'])){
            $input['expireTime'] = strtotime($input['expiredOn']);
        }
        if(isset($input['productInfo'])){
            if(isset($input['productInfo']['spec'])){
                $input['skuCode'] = $input['productInfo']['spec'];
            }
            if(isset($input['productInfo']['timeSpan']) && isset($input['productInfo']['timeUnit'])){
                $timeSpan = $input['productInfo']['timeSpan'];
                $timeUnit = $input['productInfo']['timeUnit'];
                $input['expireTime'] = self::_tceTimeParse($timeSpan,$timeUnit);
            }
        }
        if(isset($input['expireOn'])){
            $input['expireTime'] = $input['expireOn']/1000;
        }
        if(isset($input['signId'])){
            $input['instanceId'] = $input['signId'];
        }
        if(isset($input['mobilePhone'])){
            $input['mobile'] = $input['mobilePhone'];
        }
        if(isset($input['extendParams'])){
            try{
                $extendParams = json_decode($input['extendParams'],true);
                if(isset($extendParams['phone'])){
                    $input['mobile'] = $extendParams['phone'];
                }
                if(isset($extendParams['email'])){
                    $input['email'] = $extendParams['email'];
                }
            }catch(\Exception $e){

            }
        }

        return $input;
    }

    /**
     * 格式化腾讯云市场时间
     * @param number $timeSpan
     * @param string $timeUnit
     * @return number
     */
    private static function _tceTimeParse($timeSpan,$timeUnit)
    {
        $unitMap = [
            'y' => 'year',
            'm' => 'month',
            'd' => 'day',
            'h' => 'hour',
            't' => ''
        ];
        $expireTime = 0;
        if(isset($unitMap[$timeUnit]) && $unitMap[$timeUnit]){
            $expireTime = strtotime('+'.$timeSpan.' '.$unitMap[$timeUnit]);
        }
        return $expireTime;
    }
}