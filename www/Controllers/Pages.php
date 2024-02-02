<?php

namespace App\Controllers;


use App\Core\View;
use App\Models\Pages as PagesModel;
use App\Forms\CreatePage;

class Pages
{


    public function index(): void
    {
        $view = new View("Admin/Pages/index", "back");
        $pages = new PagesModel();
        $view->assign("pages", $pages->getAllPages());
    }

    public function create(): void
    {
        $view = new View("Admin/Pages/create", "back");
        $form = new CreatePage();
        $view->assign('config', $form->getConfig());

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['title'] != "") {
            $page = new PagesModel();
            $page->setTitle($_POST['title']);
            $page->setMeta_description($_POST['meta_description']);
            $page->setMiniature($_POST["files"]);
            $page->setComments(isset($_POST['comments']) ? 1 : 0);
            var_dump($page->getComments());
            $page->setContent($_POST['content']);
            if ($page->save()) {
                // L'insertion/mise à jour a réussi
                echo "Sauvegarde réussie.";
            } else {
                // L'insertion/mise à jour a échoué
                echo "Sauvegarde échouée.";
            }
        }
    }
}