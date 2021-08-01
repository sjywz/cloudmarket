# 国内各大云市场sass快速接入

支持百度、京东、华为、腾讯、金山
### 要求

1. PHP >= 7.2
2. **[Composer](https://getcomposer.org/)**
3. openssl 拓展 (华为、金山需要)

### 说明

- 接入前请先仔细阅读各大应用市场接入文档
- 华为敏感数据加密算法请选择：AES128_CBC_PKCS5Padding

### 安装
`composer require lzhy/cloudmarket`

### 初始化
```php
use Lzhy\Cloudmarket\Market;

/** $cloud取值：jd/bce/hce/tce/ksyun **/
$market = new Market($cloud,$keyortoken) //百度
$market->checkSign(); //效验
$market->input($unify = false); //参数$unify 是否统一部分参数
//除了百度，华为、金山之外可自行返回json
$market->response($data); //包装返回
```

### 单独实例
```php
use Lzhy\Cloudmarket\Support\Bce;
use Lzhy\Cloudmarket\Support\Hce;
use Lzhy\Cloudmarket\Support\Jd;
use Lzhy\Cloudmarket\Support\Ksyun;
use Lzhy\Cloudmarket\Support\Tce;

//以百度为例
$bMarket = new Bce($keyortoken);
$bMarket->checkSign(); //效验
$bMarket->unify(false)->input($parse = false); //请求参数 如果是金山云或华为云请传入true解析敏感加密数据
//除了百度，华为、金山之外可自行返回json
$bMarket->response($data); //返回
```

### License

MIT
