<?php

namespace App\Repositories\Ingredient;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface IngredientRepository.
 *
 * @package namespace App\Repositories\Ingredient;
 */
interface IngredientRepository extends RepositoryInterface
{
    public function getAll($request);
}
