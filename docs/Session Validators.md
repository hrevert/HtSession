# Session Validators

Session validators provide various protection against session hijacking. Please view [this](http://framework.zend.com/manual/2.2/en/modules/zend.session.validator.html) one first.

## Using Session Validators

That is pretty easy.

```php
return [
    'htsession' => [
        'options' => [
            'validators' => [
                // validators list goes here
            ]        
        ]
    ]
];
```
Zend Framework 2 comes with 2 session validators:

1. [`Zend\Session\Validator\RemoteAddr`](https://github.com/zendframework/zf2/blob/master/library/Zend/Session/Validator/RemoteAddr.php)
2. [`Zend\Session\Validator\HttpUserAgent`](https://github.com/zendframework/zf2/blob/master/library/Zend/Session/Validator/HttpUserAgent.php)

## Creating custom session validators
To create a custom role providers, you first need to create a class that implements the Zend\Session\Validator\ValidatorInterface interface.

Then, you need to add it to the session validator plugin manager this way:

```php
return [
    'htsession' => [
        'validators' => [
            'factories' => [
                'Application\Session\Validator\MySessionValidator' => `Application\Factory\MySessionValidatorFactory`
            ]
        ]
    ]
];

```
Now, your session validator is only added to the session validator plugin manager. To use this:

```php
return [
    'htsession' => [
        'options' => [
            'validators' => [
                'Application\Session\Validator\MySessionValidator'
            ]        
        ]
    ]
];
```
