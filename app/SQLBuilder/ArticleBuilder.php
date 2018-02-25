<?php

namespace App\SQLBuilder;


/**
 * Class ArticleBuilder
 */
class ArticleBuilder extends Builder
{
    /**
     * article を between 条件で検索する SQL をビルドする
     *
     * @param string $columns カラム
     * @param string $sortKey ソートするカラム
     * @param string $sort    ソート順
     * @return string SQL を返す
     * @throws Reader\SQLEmptyException SQL が空の時に投げる
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException File が存在しない時に投げる
     */
    public function findByBetween(string $columns, string $sortKey, string $sort)
    {
        $format = $this->SQLReader->get('articles.find_by_between');

        return sprintf($format, $columns, $sortKey, $sort);
    }

    /**
     * article テーブルのレコード数を取得する SQL をビルドする
     *
     * @return string SQL を返す
     * @throws Reader\SQLEmptyException SQL が空の時に投げる
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException File が存在しない時に投げる
     */
    public function count()
    {
        return $this->SQLReader->get('articles.count');
    }
}
