<?php

namespace App\Repositories;

use App\SQLBuilder\ArticleBuilder;
use Illuminate\Database\DatabaseManager;

/**
 * Class ArticleRepository
 */
class ArticleRepository extends Repository
{
    /** PRIMARY_KEY 主キー */
    const PRIMARY_KEY = 'seq';

    /** @var DatabaseManager $DB */
    private $DB;
    /** @var ArticleBuilder $Builder */
    private $Builder;

    /** @var array */
    protected $accessible = [
        'seq',
        'title',
        'content',
    ];

    /**
     * ArticleRepository constructor.
     *
     * @param DatabaseManager $databaseManager DatabaseManager を DI
     * @param ArticleBuilder  $articleBuilder  ArticleBuilder を DI
     */
    public function __construct(DatabaseManager $databaseManager, ArticleBuilder $articleBuilder)
    {
        $this->DB      = $databaseManager;
        $this->Builder = $articleBuilder;
    }

    /**
     * between 条件で記事情報を取得する
     *
     * @param integer $start   BETWEEN の開始値
     * @param integer $end     BETWEEN の終了値
     * @param string  $sortKey ソートするカラム
     * @param string  $sort    ソート順
     * @return array 記事情報を返す
     */
    public function findByBetween(int $start, int $end, string $sortKey = self::PRIMARY_KEY, string $sort = 'ASC')
    {
        $query = $this->Builder->findByBetween($this->columns(), $sortKey, $sort);

        return $this->DB->select($query, [$start, $end]);
    }

    /**
     * article テーブルのレコード数を取得する
     *
     * @return integer レコード数を返す
     */
    public function count()
    {
        $query  = $this->Builder->count();
        $result = $this->DB->selectOne($query);
        if (empty($result)) {
            return 0;
        }

        return $result->aggregate;
    }
}
