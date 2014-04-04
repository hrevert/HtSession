HtSession
=========

A Zend Framework 2 module to manage session configurations, session validators, storing session data in database.

##Requirements
* [Zend Framework 2](https://github.com/zendframework/zf2)
 
##Installation
* Add `"hrevert/ht-session": "1.1.*",` to your composer.json and run `php composer.phar update`
* Enable the module in `config/application.config.php`
* Copy file located in `./vendor/hrevert/ht-session/config/HtSession.global.php` to `./config/autoload/HtSession.global.php` and change the values as you wish

##Options

Check Options available in `config/HtSession.global.php`

##Features
* Session configurations
* Session set save handler
* Session Validators

#### Session configurations

You can set all the session options as session name, save path etc.

```php
return [
   'htsession' => [
       'config_options' => array(
              'name' => 'my_application',
              'save_path' => 'data/session'
        ),
        'storage' => 'Zend\Session\Storage\SessionArrayStorage',
     ]
];
```

#### Session set save handler

This module also comes with session set save handler to store session data in database.
By default `session_set_save_hander` is already enabled. If you want to disable it, disable it in the following settings:

```php
return [
   'htsession' => [
      'enable_session_set_save_handler' => true, // false if you don`t want to store session data in database
   ],
   'service_manager' => [
      'aliases' => [
         'HtSessionDbAdapter' => 'Zend\Db\Adapter\Adapter', // your database adapter here
         'HtSession\SessionSetSaveHandler' => 'HtSession\DefaultSessionSetSaveHandler'
      ]
   ]
];
```


`Note`: Dont forget to import schema available in `data/mysql.sql` to use `session_set_save_handler`

If you use [Doctrine DBAL](https://github.com/doctrine/dbal):
```php
return [
   'service_manager' => [
      'aliases' => [
         'HtSession\SessionSetSaveHandler' => 'HtSession\DoctrineDbalSessionSetSaveHandler'
      ]
   ]
];
```

#### Session Validators

You can set validators provided by Zend Framework 2 with ease.
Change the following as you wish in the config file:

```php
return [
   'htsession' => [
       'validators' => array(
           'Zend\Session\Validator\RemoteAddr',
           'Zend\Session\Validator\HttpUserAgent',    
        ),      
   ]
];
```

For more detailed description, click [here](https://github.com/hrevert/HtSession/blob/master/docs/Session%20Validators.md).

## Ending Thoughts

Dont forget to fork this module and send pull request to make this module even better!


[![Bitdeli Badge](https://d2weczhvl823v0.cloudfront.net/hrevert/htsession/trend.png)](https://bitdeli.com/free "Bitdeli Badge")

