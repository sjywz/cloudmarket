# 各大云市场对接

```php
use Lzhy\Cloudmarket\Support\Bce;
use Lzhy\Cloudmarket\Support\Hce;
use Lzhy\Cloudmarket\Support\Jd;
use Lzhy\Cloudmarket\Support\Ksyun;
use Lzhy\Cloudmarket\Support\Tce;
```

#### 公共方法
```php
function checkSign(); //效验
function input($prase = false); //请求参数
function parseInput($input); //解析加密参数
function response($data); //返回
```

### 百度云
`new Bce('token/key')`
### 腾讯云
`new Tce('token/key')`
### 京东云
`new Jd('token/key')`
### 华为云
`new Hce('token/key')`
### 金山云
`new Ksyun('token/key')`
