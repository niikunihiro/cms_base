<?php

namespace App\Repositories;

/**
 * Class Repository
 */
class Repository
{
    /** @var array select で取得できるカラム */
    protected $accessible = ['*'];

    /**
     * select するカラムを取得
     *
     * @param array $accessible 取得カラムを指定する
     * @return string カラム名をカンマで繋げて返す
     */
    protected function columns(array $accessible = []): string
    {
        $accessible = $accessible ?: $this->accessible;
        return implode(', ', $accessible);
    }
}
