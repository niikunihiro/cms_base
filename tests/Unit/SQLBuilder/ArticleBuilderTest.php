<?php

namespace Tests\Unit\SQLBuilder;

use App\SQLBuilder\ArticleBuilder;
use App\SQLBuilder\Reader\FileLoader;
use App\SQLBuilder\Reader\SQLReader;
use Illuminate\Filesystem\Filesystem;
use PHPUnit\Framework\TestCase;

/**
 * Class ArticleBuilderTest
 * @package Tests\Unit\SQLBuilder
 */
class ArticleBuilderTest extends TestCase
{
    /** @var ArticleBuilder $Builder */
    private $Builder;

    public function setUp()
    {
        parent::setUp();
        // 実ファイルを確認するので Mockery 使わない
        $this->Builder = new ArticleBuilder(new SQLReader(new Filesystem, new FileLoader));
    }

    /**
     * @test
     * @throws \App\SQLBuilder\Reader\SQLEmptyException
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function findByBetweenの返すSQLを確認()
    {
        $expected = <<<SQL
SELECT *
FROM article
WHERE seq BETWEEN ? AND ?
ORDER BY seq ASC
SQL;

        $actual = $this->Builder->findByBetween('*', 'seq', 'ASC');

        $this->assertSame($expected, $actual);
    }

    /**
     * @test
     * @throws \App\SQLBuilder\Reader\SQLEmptyException
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function countの返すSQLを確認()
    {
        $expected = <<<SQL
SELECT count(*) AS aggregate FROM article
SQL;

        $actual = $this->Builder->count();

        $this->assertSame($expected, $actual);
    }
}
