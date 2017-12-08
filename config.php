<?php

/**
 * Used to store website configuration information.
 *
 * @var string
 */
function config($key = '')
{
    $env = "test";
    // $env = "production";
    $config = [
        'name' => 'Chef Z',
        'class' => 'SJSU CMPE 272',
        'nav_menu' => [
            '' => 'Home',
            'products' => 'Products',
            'news' => 'News',
            'about-us' => 'About',
            'contact' => 'Contact',
            'user' => 'User',
            'market' => 'Market'
        ],
        'template_path' => 'template',
        'content_path' => 'content',
        'pretty_uri' => true,
        'version' => 'v1.0'
    ];

    if ($env == "production") {
        $config['root'] = '/';
        $config['url'] = 'ec2-13-56-13-41.us-west-1.compute.amazonaws.com';
    } else {
        $config['root'] = '/chef/';
        $config['url'] = 'localhost:8080';
    }


    return isset($config[$key]) ? $config[$key] : null;
}
