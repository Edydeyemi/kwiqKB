<?php

declare(strict_types=1);

namespace kwiqKB;

use DB;

/**
 * Class ArticleListing
 * @package kwiqKB
 */
class Article extends ArticleListing
{

    protected $article_id;


    /**
     * Returns a single article entry from the Articles table based on the submitted article id
     * @param   int     $article_id
     * @return  array
     */
    public function viewArticle(int $article_id)
    {
        $articles = $this->allArticles("articles.id = $article_id");
        if (DB::count() < 1) {
            return false;
        }
        return $articles[0];
    }

    /**
     * Fetches single article irrespective of publish status
     */
    public function editArticle(int $id)
    {
        $record = DB::queryFirstRow("SELECT `id`, `title`, `cat_id`, `type`, `contents`, `date_posted`, `posted_by`, `is_published` FROM `articles` WHERE id = %i", $id);
        if (DB::count() <> 1) {
            return false;
        }
        return $record;
    }

    /** Update article */
    public function updateArticle(array $data, int $article_id): bool
    {
        $title = $data['title'];
        $cat_id = $data['category'] ?? '0';
        $type = $data['type'];
        $contents = htmlentities($data['contents'], ENT_QUOTES);
        $status = $data['status'];

        DB::update('articles', array(
            'title'         =>  $title,
            'cat_id'        =>  $cat_id,
            'type'          =>  $type,
            'contents'      =>  $contents,
            'is_published'  =>  $status,
            'date_posted'   =>  date('Y-m-d H:i:s'),
            'posted_by'     =>  $_SESSION['fullname'] ?? 'Edydeyemi'
        ), "id=%i", $article_id);

        if (DB::affectedRows() != 1) {
            return false;
        }

        return true;
    }

    /** Move article to the recycle bin */
    public function trashArticle(int $article_id): bool
    {

        DB::update('articles', array(
            'is_published'   => 'No',
            'is_deleted'     =>  'Yes',
            'date_deleted'   =>  date('Y-m-d H:i:s'),
            'deleted_by'     =>  $_SESSION['fullname'] ?? 'Edydeyemi'
        ), "id=%i", $article_id);

        if (DB::affectedRows() != 1) {
            return false;
        }

        return true;
    }

    /** Move article to the recycle bin */
    public function restoreArticle(int $article_id): bool
    {
        DB::update('articles', array(
            'is_deleted'     =>  'No',
            'date_deleted'   =>  NULL,
            'deleted_by'     =>  NULL
        ), "id=%i", $article_id);

        if (DB::affectedRows() != 1) {
            return false;
        }

        return true;
    }


    /** Delete article forever */
    public function deleteArticle(int $article_id): bool
    {
        DB::query("DELETE FROM articles where id = %i", $article_id);
        if (DB::affectedRows() != 1) {
            return false;
        }

        return true;
    }


    public function unpublishArticle(int $article_id): bool
    {
        DB::query("UPDATE articles SET is_published = 'No' WHERE id = %i", $article_id);
        if (DB::affectedRows() != 1) {
            return false;
        }

        return true;
    }



    public function listRelatedArticles($article_id)
    {
        // var_dump($article_id);
        // return DB::query("SELECT `id`, `title` FROM articles WHERE cat_id = $cat_id AND id <> $id AND  is_published = 'Yes' ORDER BY title DESC LIMIT 15");
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
