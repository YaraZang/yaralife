<?php

/**
 * Used to store website configuration information.
 *
 * @var string
 */
function config($key = '')
{
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
        'version' => 'v1.0',
        'root' => '/'
    ];

    return isset($config[$key]) ? $config[$key] : null;
}
