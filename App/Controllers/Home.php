<?php

namespace App\Controllers;

use \Core\View;

/**
 * Home controller
 *

 */
class Home extends \Core\Controller {

    /**
     * Before filter
     *
     * @return void
     */
    protected function before() {
        //echo "(before) ";
        //return false;
    }

    /**
     * After filter
     *
     * @return void
     */
    protected function after() {
        //echo " (after)";
    }

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction() {
        if (isset($_SESSION['userLogged'])) {
            header('Location: /news');
        } else {
            header('Location: /authentification');
        }
    }

    public function submitAction() {
        var_dump($_POST);
    }
}