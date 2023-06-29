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
        $parameters['error'] = "";
        if ($_POST) {
            $username = htmlentities($_POST['username'], ENT_QUOTES, "UTF-8");
            $password = htmlentities($_POST['password'], ENT_QUOTES, "UTF-8");
            if ($username == "admin" && $password == "test") {
                $_SESSION['userLogged'] = true;
                header('Location: /news');
            } else {
                $parameters['error'] = "Wrong Login Data!";
            }
        }
        View::render('Authentification/index.php', $parameters);
    }

    public function submitAction() {
        var_dump($_POST);
    }

    public function logoutAction() {
        session_unset();
        header('Location: /authentification');
    }

}