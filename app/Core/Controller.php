<?php
namespace App\Core;

/**
 * Base Controller for CallFrend
 */
abstract class Controller {
    protected $route_params = [];

    public function __construct($route_params) {
        $this->route_params = $route_params;
    }

    // Future: Add view rendering method here
    protected function render($view, $args = []) {
        extract($args, EXTR_SKIP);
        $file = "views/$view.php";
        if (is_readable($file)) {
            require $file;
        } else {
            echo "$file not found";
        }
    }
}
