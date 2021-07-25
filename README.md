# 各大云市场对接

```php
use Lzhy\Cloudmarket\Support\Bce;
use Lzhy\Cloudmarket\Support\Hce;
use Lzhy\Cloudmarket\Support\Jd;
use Lzhy\Cloudmarket\Support\Ksyun;
use Lzhy\Cloudmarket\Support\Tce;
```

### 百度云
`new Bce('token')`
### 腾讯云
`new Tce('dabashanwanglou')`
### 京东云
`new Jd('B2D6479699D2B3D75CF142FB711CDEC3')`
### 华为云
`new Hce('a6471e91-2806-444c-ba3f-e0f5da03c516')`
### 金山云
`new Ksyun('OvPubFWUAifBKU4A')`


```php
function checkSign(); //效验
function input($prase = false); //请求参数
function parseInput($input); //解析加密参数
function response($data); //返回
```