# phputil
A PHP Util Package


# composer test
```
composer init
```

composer local development:
```
composer config repositories.backtend path "D:\backtend\phputil"
composer require backtend/phputil:^1.0 -vvv

composer update backtend/phputil
```


local composer package, must reset if composer.json been modify:
```
composer remove backtend/phputil
composer require backtend/phputil
```


# Version Memo
[Version Tips](https://semver.org/lang/zh-CN/)

```blade
1.0.0-alpha < 1.0.0-alpha.1 < 1.0.0-alpha.beta 
< 1.0.0-beta < 1.0.0-beta.2 < 1.0.0-beta.11 
< 1.0.0-rc.1 < 1.0.0
```