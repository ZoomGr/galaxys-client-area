<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been set up for each driver as an example of the required values.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [
//        'medias' => [
//            'driver' => 's3',
//            //'root' => public_path('all-files'),
//            //'root' => 'upload-images/',
//            'bucket' => env('AWS_BUCKET', 'imaginelive'),
//            'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
//            'key' => env('AWS_SECRET_ACCESS_KEY', 'laLoNg'),
//            'secret' => env('AWS_ACCESS_KEY_ID', 'origaMi8'),
////            'url' => 'http://127.0.0.1:9000/',
//            'endpoint' => env('AWS_ENDPOINT', 'http://172.104.145.210:9000'),
//            'lifetime' => env("AWS_TEMPORARY_URL_LIFETIME_IN_MINUTES", 10),
//            //'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
//        ],
        'medias' => [
            'base_url' => env('CEPH_BASE_URL', 'xxxxxxxxx'),
            'driver' => 'ceph',
            'key' => env('CEPH_ACCESS_KEY', 'xxxxxxx'),
            'credentials' => [
                'key' => env('CEPH_ACCESS_KEY', 'xxxxxxx'),
                'secret' => env('CEPH_SECRET_KEY', 'xxxxxxx'),
            ],
            'region' => 'US',
            'bucket' => env('CEPH_BUCKET', 'test'),
            'version' => env('CEPH_VERSION', 'latest'),
            'ACL' => env('CEPH_ACL', 'private'),
            'visibility' => env('CEPH_VISIBILITY', 'private')
        ],
        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
