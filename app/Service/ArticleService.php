<?php

namespace App\Service;

use App\Repositories\ArticleRepository;

/**
 * Class ArticleService
 */
class ArticleService
{
    /** @var ArticleRepository $repository */
    private $repository;

    /**
     * ArticleService constructor.
     *
     * @param ArticleRepository $repository ArticleRepository を DI
     */
    public function __construct(ArticleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * ページネーション向け記事情報を取得
     *
     * @param integer $start 開始シーケンス
     * @param integer $limit 取得数
     * @return array
     */
    public function paginate(int $start, int $limit = 30)
    {
        // select * from article where seq between (1-1) and (1+30);
        // select * from article where seq between ($start-1) and ($start+$limit);
        $end = $start + $limit;

        $articles = $this->repository->findByBetween(($start - 1), $end);

        return $this->fetchPagination($articles, $start, $end, $limit);
    }

    /**
     * 記事情報とページネーション情報を整形する
     *
     * @param array   $data  取得データ
     * @param integer $start 開始シーケンス
     * @param integer $end   終了シーケンス
     * @param integer $limit 取得数
     * @return array
     */
    protected function fetchPagination(array $data, int $start, int $end, int $limit)
    {
        // first
        $first = 1;
        if ($start === 1) {
            $first = null;
        }
        // previous
        $previous = null;
        if ($data[0]->seq === ((int)$start - 1)) {
            $previous = max(1, $data[1]->seq - $limit);
            unset($data[0]);
        }
        // next
        $next = null;
        if ($limit < count($data)) {
            $next = $end;
            array_pop($data);
        }
        // last
        $last = null;
        if (count($data) === $limit) {
            $aggregate = $this->repository->count();
            $last      = $aggregate - ($aggregate % $limit);
        }

        $pagination = compact('first', 'previous', 'next', 'last');

        return compact('data', 'pagination');
    }
}
