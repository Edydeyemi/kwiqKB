<?php

namespace kwiqKB\Controllers;

use kwiqKB\Article;

class ArticleController extends MainController
{

    private $article;
    private $msg;
    private $articledata;

    // TODO - Create function for sa ving articles as drafts

    public function __construct()
    {
        $this->article = new Article();
        $this->msg = new \Plasticbrain\FlashMessages\FlashMessages();
    }


    public function viewArticle($id): void
    {

        $this->articledata = $this->article->viewArticle($id);
        if ($this->articledata) {
            $this->renderView('articles',  $this->articledata);
        } else {
            $this->msg->error("Sorry, no records found", HOME);
        }
    }


    /** 
     * Load the Edit Post View page nand inject article data into form
     */
    public function editArticle($id)
    {

        $this->articledata = $this->article->editArticle($id);
        if (!$this->articledata) {
            $this->msg->error("Sorry, no records found", getenv("HOME"));
            return false;
        }

        $this->renderView('articles_edit', $this->articledata);
    }


    /** 
     * Save changes to the DB
     */
    public function updateArticle($id)
    {

        if (!$this->article->updateArticle($_POST, $id)) {
            $this->msg->error("Sorry, update failed");
            // $this->article->viewArticle($id, $_POST);
            return false;
        }

        $this->msg->success("great, article updated");
    }


    /** 
     * Move article to the recycle bin
     **/
    public function trashArticle($id)
    {
        if (!$this->article->trashArticle($id)) {
            $this->msg->error("Sorry, an error occured", getenv("HOME"));
            echo json_encode(["status" => "FAILED"]);
            return false;
        }

        echo json_encode(["status" => "SUCCESS"]);
        return true;
        // $this->msg->success("Article moved to the recycle bin", getenv("HOME") . '/admin');

    }

    /** 
     * Restore article from Recycle Bin
     **/
    public function restoreArticle($id)
    {
        if (!$this->article->restoreArticle($id)) {
            $this->msg->error("Sorry, an error occured", getenv("HOME"));
            echo json_encode(["status" => "FAILED"]);
            return false;
        }

        echo json_encode(["status" => "SUCCESS"]);
        return true;
        // $this->msg->success("Article moved to the recycle bin", getenv("HOME") . '/admin');

    }

    /** 
     * Restore article from Recycle Bin
     **/
    public function deleteArticle($id)
    {
        if (!$this->article->deleteArticle($id)) {
            $this->msg->error("Sorry, an error occured", getenv("HOME"));
            echo json_encode(["status" => "FAILED"]);
            return false;
        }

        echo json_encode(["status" => "SUCCESS"]);
        return true;
        // $this->msg->success("Article moved to the recycle bin", getenv("HOME") . '/admin');

    }
}
