<?php


namespace kwiqKB\Controllers;

/**
 * Class MainController
 * @package kwiqKB\Controllers
 */
class MainController
{
    public $view, $data;

    protected function renderView(string $view, $data = null)
    {
        if (file_exists(BASEURL . '/src/views/' . $view . '.php')) {
            require_once  BASEURL . '/src/views/' . $view . '.php';
        } else {
            header('HTTP/1.0 404 Not Found');
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(array("message" => "Page Not Found."));
            exit();
        }
    }
}
