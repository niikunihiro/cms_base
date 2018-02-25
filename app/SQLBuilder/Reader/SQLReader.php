<?php

namespace App\SQLBuilder\Reader;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;

/**
 * Class SQLReader
 */
class SQLReader
{
    /** @var Filesystem $files */
    private $files;
    private $loader;

    /**
     * SQLReader constructor.
     *
     * @param Filesystem $filesystem DI で Filesystem をセット
     * @param FileLoader $loader     DI で FileLoader をセット
     */
    public function __construct(Filesystem $filesystem, FileLoader $loader)
    {
        $this->files = $filesystem;
        $this->loader = $loader;
    }

    /**
     * SQL 文を取得する
     *
     * @param string $path SQL ファイルパス
     * @return string
     * @throws FileNotFoundException FileNotFoundException をファイルが存在しない時に投げる
     * @throws SQLEmptyException SQL が空の時に投げる
     */
    public function get(string $path)
    {
        // SQL ファイルパスを取得
        $sqlPath = $this->loader->load($path);
        // ファイルをロードする
        $sql = $this->files->get($sqlPath);
        if (empty($sql)) {
            throw new SQLEmptyException("File is empty. Path is {$sqlPath}");
        }
        // SQL文を返す
        return $sql;
    }
}