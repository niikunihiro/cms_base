<?php

namespace Tests\Unit\SQLReader;

use App\SQLReader\FileLoader;
use Tests\TestCase;

/**
 * Class FileLoaderTest
 */
class FileLoaderTest extends TestCase
{
    /** @var FileLoader $loader */
    private $loader;

    /**
     * setUp
     */
    public function setUp()
    {
        $this->loader = new FileLoader;
    }

    /**
     * @test
     */
    function loadがdotをslashに変換することを確認()
    {
        $expected = 'articles/paginate' . FileLoader::SQL_EXT;
        $actual = $this->loader->load('articles.paginate');

        $this->assertNotFalse(strpos($actual, $expected));
    }

    /**
     * @test
     */
    function loadにslashのパスを渡しても大丈夫なことを確認()
    {
        $expected = 'articles/paginate' . FileLoader::SQL_EXT;
        $actual = $this->loader->load('articles/paginate');

        $this->assertNotFalse(strpos($actual, $expected));
    }

    /**
     * @test
     */
    function loadに拡張子付きのslashのパスを渡しても大丈夫なことを確認()
    {
        $expected = 'articles/paginate' . FileLoader::SQL_EXT;
        $actual = $this->loader->load('articles/paginate.sql');

        $this->assertNotFalse(strpos($actual, $expected));
    }
}
