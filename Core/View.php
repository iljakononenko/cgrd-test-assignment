<?php

namespace Core;

/**
 * View
 *

 */
class View
{

    /**
     * Render a view file
     *
     * @param string $view  The view file
     * @param array $args  Associative array of data to display in the view (optional)
     *
     * @return void
     */
    public static function render($view, $args = []) {
        extract($args, EXTR_SKIP);

        $header = "../App/Views/partials/header.php";  // relative to Core directory
        $file = "../App/Views/$view";

        if (is_readable($file)) {
            require "../App/Views/template.php";
        } else {
            throw new \Exception("$file not found");
        }
    }

}
