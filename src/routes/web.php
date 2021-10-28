<?php

namespace kwiqKB;

use kwiqKB\Controllers\MainController;

// In case one is using PHP 5.4's built-in server
$filename = __DIR__ . preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
if (php_sapi_name() === 'cli-server' && is_file($filename)) {
    return false;
}

// Create a Router
$router = new \Bramus\Router\Router();

// Custom 404 Handler
$router->set404(function () {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
});

// Before Router Middleware
$router->before('GET|POST', '/.*', function () {

    header('X-Powered-By: Edydeyemi');
    header("Access-Control-Allow-Origin: *");
    header("Content-Security-Policy: default-src https:");
    header("Strict-Transport-Security: max-age=63072000");
    header("X-Content-Type-Options: nosniff");
    header("Content-Security-Policy: frame-ancestors 'self'");
    header("X-Frame-Options: SAMEORIGIN");
    header("X-XSS-Protection: 1; mode=block");
});

$router->match('GET', '/test', function () {
    (new Database());
});


// =================> APP ROUTES BEGIN <======================

//Define Route Namespace
$router->setNamespace('kwiqKB\Controllers');

$router->match('GET', '/', 'HomePageController@homepage');


// 1. AUTHENTICATION



// 2. ARTICLES
$router->mount('/articles', function () use ($router) {

    $router->match('GET', '/', 'ArticleListingController@fetchArticles');
    $router->match('GET', '/(\d+)', 'ArticleController@viewArticle');
});



// 3. CATEGORIES


// 4. TAGS



//5. ADMIN
$router->mount('/admin', function () use ($router) {

    //Articles Management
    $router->mount('/articles', function () use ($router) {

        $router->match('GET', '/new', 'ArticleListingController@addArticle');
        $router->match('POST', '/new', 'ArticleListingController@saveArticle');

        $router->match('GET', '/edit/(\d+)', 'ArticleController@editArticle');
        $router->match('POST', '/edit/(\d+)', 'ArticleController@updateArticle');


        $router->match('GET', '/recycle-bin', 'ArticleListingController@listTrashedArticles');
        $router->match('GET|POST', '/trash/(\d+)', 'ArticleController@trashArticle');
        $router->match('GET|POST', '/restore/(\d+)', 'ArticleController@restoreArticle');
        $router->match('GET|POST', '/delete/(\d+)', 'ArticleController@deleteArticle');
    });
});

$router->run();
