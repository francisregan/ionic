<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        // Database settings
        'db' => [
            'host' => '127.0.0.1',
            'user' => 'root',
            'pass' => 'mysql',
            'dbname' => 'ioniccloud'
        ], 

        'files' => [
            'lesson_dir' => 'C://Program Files (x86)//Ampps//www//Ionic File//'
        ],
    ],
];
?>