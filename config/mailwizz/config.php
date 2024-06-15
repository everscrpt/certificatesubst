<?php
return [
    'mailwizz' => [
        'apiUrl'        => env('MAILWIZZ_API_URL'),
        'publicKey'     => env('MAILWIZZ_PUB_KEY'),
        'privateKey'    => env('MAILWIZZ_PRV_KEY'),
    
        // components
        'components' => array(
            'cache' => array(
                'class'     => 'MailWizzApi_Cache_File',
                'filesPath' => dirname(__FILE__) . '/../MailWizzApi/Cache/data/cache', // make sure it is writable by webserver
            )
        ),
      ]

];