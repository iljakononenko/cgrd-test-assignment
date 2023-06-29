<?php

namespace App\Controllers;

use Core\View;

class Authentification extends \Core\Controller {

    /**
     * Before filter
     *
     * @return void
     */
    protected function before() {
        if (isset($_SESSION['userLogged'])) {
            header('Location: /news');
        }
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
        $parameters = [];
        if ($_POST) {
            if ($_POST['username'] == "admin" && $_POST['password'] == "test") {
                $_SESSION['userLogged'] = true;
                header('Location: /news');
            } else {
                $parameters['error'] = "Wrong Login Data!";
            }
        }
        View::renderTemplate('Home/index.html', $parameters);
    }

    public function submitAction() {
        var_dump($_POST);
    }

    public function logoutAction() {
        session_unset();
        header('Location: /authentification');
    }

}