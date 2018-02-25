<?php

namespace App\SQLBuilder\Reader;

/**
 * Class FileLoader
 */
class FileLoader
{
    /** SQL_EXT SQL ファイル拡張子 */
    const SQL_EXT = '.sql';

    /**
     * @param string $path ファイルパス.
     * @return string
     */
    public function load(string $path)
    {
        // 拡張子があれば削除しておく
        $path = str_replace(self::SQL_EXT, '', $path);
        return database_path('sql/' . str_replace('.', '/', $path) . self::SQL_EXT);
    }
}
