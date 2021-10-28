<?php

declare(strict_types = 1);

namespace kwiqKB;

use DB;

class ArticleListing
{
    protected $db;
    private $article_id;


    public function __construct()
    {
        $this->db = new Database;
    }


    protected function allArticles($filter = null, $order = null): array
    {
        $sort_by = $order ?? 'articles.id';
        $filter = $filter ? "AND $filter" : "";
        return DB::query("SELECT articles.`id`, `title`, `cat_id`, `category`, articles.`type`, `contents`, `date_posted`, `posted_by`, `is_published`, `ratings`, `views`, date_updated, updated_by FROM `articles` JOIN categories ON cat_id = categories.id WHERE is_published = 'Yes' AND is_deleted = 'No' $filter ORDER by $sort_by");
    }


    public function fetchArticles()
    {

        return $this->allArticles();
    }


    public function listPopularArticles(): array
    {
        return DB::query("SELECT articles.`id`, `title`, `cat_id`, `category`, articles.`type`, `contents`, `date_posted`, `posted_by`, `is_published`, `ratings`, `views` FROM `articles` JOIN categories ON cat_id = categories.id WHERE is_published = 'Yes' ORDER BY views DESC LIMIT 10");
    }


    public function listTrashedArticles(): array
    {
        return DB::query("SELECT `id`, `title`, `cat_id`, `type`, `contents`, `date_posted`, `posted_by`, `is_published` FROM `articles` WHERE is_deleted = 'Yes'");
    }


    public function saveArticle(array $data)
    {

        $title = $data['title'];
        $cat_id = $data['category'] ?? '0';
        $type = $data['type'];
        $contents = htmlentities($data['contents'], ENT_QUOTES);
        $status = $data['status'];

        $sql = DB::insert("articles", array(
            'title'         =>  $title,
            'cat_id'        =>  $cat_id,
            'type'          =>  $type,
            'contents'      =>  $contents,
            'is_published'  =>  $status,
            'date_posted'   =>  date('Y-m-d H:i:s'),
            'posted_by'     =>  $_SESSION['fullname'] ?? 'Edydeyemi'
        ));
        $count1 = DB::affectedRows();

        if ($count1 != 1) {

            return false;
        }

        return true;
    }
}
