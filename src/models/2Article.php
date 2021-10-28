<?php

namespace kwiqKB;

use DB;;

class Article
{
    protected $db;
    private $article_id;

    public function __construct()
    {
        $this->db = new Database;
    }

    protected function allRecords($filter = null, $order = null): array
    {
        $sort_by = $order ?? 'articles.id';
        $filter = $filter ? "AND $filter" : "";
        return DB::query("SELECT articles.`id`, `title`, `cat_id`, `category`, articles.`type`, `contents`, `date_posted`, `posted_by`, `is_published`, `ratings`, `views`, date_updated, updated_by FROM `articles` JOIN categories ON cat_id = categories.id WHERE is_published = 'Yes' $filter ORDER by $sort_by");
    }


    public function fetchRecords()
    {

        return $this->allRecords();
    }

    public function singleRecord(int $id): array
    {
        return $this->allRecords("articles.id = $id");
    }


    public function storeRecord(array $data): bool
    {
    }



    public function editRecord(array $data, int $id): bool
    {
    }


    public function setID(int $article_id)
    {
        $this->article_id = $article_id;
    }

    public function getID(int $article_id)
    {
        $this->article_id;
    }
}
