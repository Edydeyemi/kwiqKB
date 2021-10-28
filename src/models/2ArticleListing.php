<?php

namespace kwiqKB;

use DB;

class ArticleListing extends Article
{

    private $article_id;


    // public function __construct(Article $article_id = null)
    // {

    //     $this->article_id = $article_id;
    // }

    public function listPopularArticles(): array
    {
        return DB::query("SELECT articles.`id`, `title`, `cat_id`, `category`, articles.`type`, `contents`, `date_posted`, `posted_by`, `is_published`, `ratings`, `views` FROM `articles` JOIN categories ON cat_id = categories.id WHERE is_published = 'Yes' ORDER BY views DESC LIMIT 10");
    }

    // public function listCategoryArticles(int $category_id): array
    // {
    // }

    public function listRelatedArticles(Article $article_id) 
    {
        var_dump($article_id);
        // return DB::query("SELECT articles.`id`, `title` FROM articles WHERE cat_id = $cat_id AND id <> $id AND  is_published = 'Yes' ORDER BY title DESC LIMIT 15");
    }
}
