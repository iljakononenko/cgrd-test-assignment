<?php

namespace App\Controllers;

use \Core\View;
use App\Models\NewsModel;

/**
 * Posts controller
 *

 */
class News extends \Core\Controller {

    /**
     *
     * @return void
     */
    protected function before() {
        if (!isset($_SESSION['userLogged'])) {
            header('Location: /authentification');
        }
        //echo "(before) ";
        //return false;
    }

    /**
     *
     * @return void
     */
    protected function after() {
        //echo " (after)";
    }

    /**
     *
     * @return void
     */
    public function indexAction() {
        $newsList = NewsModel::getAll();

        View::renderTemplate('News/index.html', [
            'newsList' => $newsList
        ]);
    }

    /**
     *
     * @return void
     */
    public function addNewsAction() {
        if ($_POST) {
            $title = htmlentities($_POST['title'], ENT_QUOTES, "UTF-8");
            $description = htmlentities($_POST['description'], ENT_QUOTES, "UTF-8");
            $newNewsId = NewsModel::addNews($title, $description);
            $newNews = NewsModel::getOne($newNewsId);
            echo json_encode((object) ["status" => 200, "message" => "post added", "newNews" => $newNews]);
        } else {
            throw new \Exception("Error occurred");
        }
    }
    
    /**
     *
     * @return void
     */
    public function editAction() {
        if ($_POST && isset($this->route_params['id'])) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            NewsModel::editNews($this->route_params['id'], $title, $description);
            echo json_encode((object) ["status" => 200, "message" => "post edited"]);
        } else {
            throw new \Exception("Error occurred");
        }
    }

    /**
     *
     * @return void
     */
    public function removeAction() {
        if (isset($this->route_params['id'])) {
            NewsModel::removeNews($this->route_params['id']);
            echo json_encode((object) ["status" => 200, "message" => "post removed"]);
        } else {
            throw new \Exception("Error occurred");
        }
    }
}
