<?php
/**
 * HtSession Configuration
 *
 * If you have a ./config/autoload/ directory set up for your project, you can
 * drop this config file in it and change the values as you wish.
 */

/**
 *
 * Accessibility Options
 *
 * Please fill this options to block unauthorized users to certain areas
 */
$accessibilityOptions = array(

    /**
     * Log In Modules
     *
     * Please set modules where logged in user can only gain access
     */
    //'modules' => array(),

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
     * Route where a user will be redirected when an unauthenticated user tries to access an unaccessible area
     *
     * Default: 'zfcuser/login'
     *
     */
     // 'login_route' => 'zfcuser/login',

);

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
    //'config_options' => array(),


    /**
     * Session Storage Class
     *
     */
    //'storage' => 'Zend\Session\Storage\SessionArrayStorage',

    /**
     * Session Validators
     *
     * Session validators provide various protection against session hijacking.
     * see http://framework.zend.com/manual/2.2/en/modules/zend.session.validator.html for more details
     */
    //'validators' => array(),


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
     * Authentication Service
     *
     * Please specify the DI alias for the configured Authentication Service instance that this module should use.
     * You donot need to provide this value if you dont want to block access to unauthorized users
     * Default : 'zfcuser_auth_service'
     */
     //'authentication_service' => 'zfcuser_auth_service',

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

/**
 * You do not need to edit below this line
 */
return array(
    'htsession' => array(
        'access' => $accessibilityOptions,
        'options' => $moduleOptions
    ),
    'service_manager' => array(
        'aliases' => array(
            'HtSessionDbAdapter' => isset($otherOptions['db_adapter']) ?  $otherOptions['db_adapter'] : 'Zend\Db\Adapter\Adapter',
            'HtSession\AuthenticationService' => isset($otherOptions['authentication_service']) ?  $otherOptions['authentication_service'] : 'zfcuser_auth_service',
            'HtSession\SessionSetSaveHandler' => isset($otherOptions['session_set_save_handler']) ?  $otherOptions['session_set_save_handler'] : 'HtSession\DefaultSessionSetSaveHandler',
        )
    )
);
