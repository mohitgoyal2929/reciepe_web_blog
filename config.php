<?php 

$config = array(
    'app' => array(
        'name' => 'Recipe Web Blog',
        'url' => 'https://localhost/recipe_web_blog/'
    ),
    'db' => array(
        'hostname' => 'localhost',
        'dbname' => 'recipe_db',
        'user' => 'root',
        'pass' => '',
    ),
    'session' => array(
        'name' => 'recipe',
        'life' => 24 * 60 * 60,
    ),
    'number_of' => array(
        'post' => 6,
    ),
    'email' => array(
        'from' => 'info@example.com',
    )
);