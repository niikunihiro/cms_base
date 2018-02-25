<?php

namespace App\SQLBuilder;

use App\SQLBuilder\Reader\SQLReader;

/**
 * Class Builder
 */
class Builder
{
    /** @var SQLReader $SQLReader */
    protected $SQLReader;

    /**
     * ArticleBuilder constructor.
     * @param SQLReader $SQLReader SQLReader を DI する
     */
    public function __construct(SQLReader $SQLReader)
    {
        $this->SQLReader = $SQLReader;
    }
}
