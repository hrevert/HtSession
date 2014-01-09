HtSession
=========

A Zend Framework 2 module to manage session configurations, session validators, storing session data in database and to block access to unauthenticated users. (Formerly ujjwal/auth)

##Requirements
The requirements of this module is listed in composer.json.
 
##Installation
* Add `"hrevert/ht-session": "dev-master",` to your composer.json and run `php composer.phar update`
* Enable the module in `config/application.config.php`
* Copy file located in `./vendor/hrevert/ht-session/config/HtSession.global.php` to `./config/autoload/HtSession.global.php` and change the values as you wish

##Options

Check Options available in `config/HtSession.global.php`

##Features
* Modules and Controllers Access
* Session configurations
* Session set save handler
* Session Validators

####Modules and Controllers Access

With this module you can restrict unauthenticated users from accessing certain controllers and modules. This can be done easily from module options. To do so, edit the `HtSession.global.php`

```php
$accessibilityOptions = array(

    /**
     * Log In Modules
     *
     * Please set modules where logged in user can only gain access
     */
    'modules' => array(
            'Admin',
            'Application',    
    ),

    /**
     * Controllers where you can set if user can access or not
     *
     * 'controllers' => array(
        'include' => array(), // Please set controllers where logged in user can only gain access


        'exclude' => array(), // Please set controllers where public user as well as logged in user can gain access
        // Note that, this part will override above `include` and `modules`
     ),
    */

    /**
     * Login Route
     *
     * Route where a user will be redirected when an unauthenticated user tried to access an unaccessible area
     *
     * Default: 'zfcuser/login'
     *
     */
     // 'login_route' => 'zfcuser/login',

);
```

#### Session configurations

You can set all the session options as session name, save path, save handler etc.
To do so, edit the `HtSession.global.php` as follows:

```php
$moduleOptions = array(
    /**
     * Session Config Class
     *
     * Name of class used to manage session config options. Useful to create your own
     * Session Config Class.  Default is Zend\Session\Config\SessionConfig.
     * The class should implement Zend\Session\Config\ConfigInterface.
     */
    //'config_class' => 'Zend\Session\Config\SessionConfig',

    /**
     * Session Config Options
     *
     * session options such as name, save_path can be set from here
     * This is the part sent to Session Config Class. Default is empty array.
     */
    'config_options' => array(
            'name' => 'my_application',
            'save_path' => 'data/session'
    ),

);
```

#### Session set save handler

This module also comes with session set save handler to store session data in database.
By default session_set_save_hander is already enabled. If you want to disable it, disable it in the following settings:

```php
$moduleOptions = array(
    /**
     * Use session save handler or not.
     * 
     * Default is true. Useful to store session data in database
     * see http://php.net/manual/en/function.session-set-save-handler.php
     * Accept values: true and false
     */
    //'enable_session_set_save_handler' => true,
);

$otherOptions = array(
     /**
      *
      * Db Adapter Instance
      *
      * Please specify the DI alias for the configured Zend\Db\Adapter\Adapter instance that this module should use.
      * You donot need to provide this value if you are not saving session data in database
      *
      * Default: 'Zend\Db\Adapter\Adapter'
      */
      //'db_adapter' => 'Zend\Db\Adapter\Adapter',

    /**
     * Session Save Handler DI Alias
     *
     * Please specify the DI alias for the configured Zend\Session\SaveHandler\SaveHandlerInterface
     * instance that this module should use.
     * Default is HtSession\DefaultSessionSetSaveHandler which is provided by this module.
     * This class should implement Zend\Session\SaveHandler\SaveHandlerInterface
     */
    //'session_set_save_handler' => 'HtSession\DefaultSessionSetSaveHandler'
);
```


`Note`: Dont forget to import schema available in `data/mysql.sql` to use `session_set_save_handler`

#### Session Validators

You can set validators provided by Zend Framework 2 with ease.
Change the following as you wish in the config file:

```php
$moduleOptions = array(
    /**
     * Session Validators
     *
     * Session validators provide various protection against session hijacking.
     * see http://framework.zend.com/manual/2.2/en/modules/zend.session.validator.html for more details
     */
    'validators' => array(
            'Zend\Session\Validator\RemoteAddr',
            'Zend\Session\Validator\HttpUserAgent',    
    ),
);

```

## Ending Thoughts

Dont forget to fork this module and send me pull request to make this module even better!
