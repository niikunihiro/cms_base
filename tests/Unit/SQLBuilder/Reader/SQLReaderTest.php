<?php

namespace Tests\Unit\SQLBuilder\Reader;

use App\SQLBuilder\Reader\SQLReader;
use Tests\TestCase;
use Mockery as m;

/**
 * Class SQLReaderTest
 * @package Tests\Unit\SQLReader
 */
class SQLReaderTest extends TestCase
{
    /** @var \Illuminate\Filesystem\Filesystem $filesMock */
    private $filesMock;
    /** @var \App\SQLBuilder\Reader\FileLoader $loaderMock */
    private $loaderMock;

    public function setUp()
    {
        parent::setUp();
        $this->filesMock  = m::mock('Illuminate\Filesystem\Filesystem');
        $this->loaderMock = m::mock('App\SQLBuilder\Reader\FileLoader');
    }

    public function tearDown()
    {
        parent::tearDown();
        m::close();
    }

    /**
     * @test
     * @throws \App\SQLBuilder\Reader\SQLEmptyException
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    function getがSQLを返すことを確認()
    {
        $query = 'SELECT * FROM article';
        $this->loaderMock->shouldReceive('load')->with('article.all')->once()->andReturn('/path/to/sql/article/all.sql');
        $this->filesMock->shouldReceive('get')->once()->andReturn($query);

        $reader = new SQLReader($this->filesMock, $this->loaderMock);
        $actual = $reader->get('article.all');
        $this->assertSame($query, $actual);
    }

    /**
     * @test
     * @throws \App\SQLBuilder\Reader\SQLEmptyException
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @expectedException \App\SQLBuilder\Reader\SQLEmptyException
     */
    function sqlが空で返る時はSQLEmptyExceptionが投げられることを確認()
    {
        $this->loaderMock->shouldReceive('load')->with('article.all')->once()->andReturn('/path/to/sql/article/all.sql');
        $this->filesMock->shouldReceive('get')->once()->andReturn('');

        $reader = new SQLReader($this->filesMock, $this->loaderMock);
        $reader->get('article.all');
    }
}
