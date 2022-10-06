<?php

namespace App\Services;

/**
 * Class BaseService.
 *
 * @package namespace App\Services;
 */
abstract class BaseService
{
    /**
     * @var $repository
     */
    public $repository;

    /**
     * BaseService constructor.
     */
    public function __construct()
    {
        $this->repository = app($this->repository());
    }

    /**
     * @return string
     */
    public abstract function repository(): string;
}
