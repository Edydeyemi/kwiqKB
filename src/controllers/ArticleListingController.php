<?php

namespace kwiqKB\Controllers;

use kwiqKB\ArticleListing;
use kwiqKB\Article;


class ArticleListingController extends MainController
{
    private $article;
    private $msg;

    public function __construct()
    {
        $this->article = new Article;
        $this->msg = new \Plasticbrain\FlashMessages\FlashMessages();
        $this->article = new ArticleListing;
    }

    /** 
     * List all publised articles 
     * */
    public function fetchArticles(): array
    {
        return $this->article->fetchArticles();
    }

    /** 
     * List all trashed articles 
     * */
    public function listTrashedArticles(): array
    {
        return $this->article->listTrashedArticles();
    }

    /**
     * Load form for creating a new article
     */
    public function addArticle()
    {

        $this->renderView('articles_new');
    }

   /**
     * Create new article
     */
    public function saveArticle(): void
    {

        if (!$this->article->saveArticle($_POST)) {
            $this->msg->success("New article created");
            $this->renderView('new_post', $_POST);
        }
        $this->msg->success("New article created");
    }


}
