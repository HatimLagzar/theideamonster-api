<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractEloquentRepository
{
    public const CONNECTION_NAME = 'mysql';

    public function getQueryBuilder(): Builder
    {
        /** @var Model $model */
        $model = app($this->getModelClass());
        $model->setConnection(self::CONNECTION_NAME);

        return $model->newQuery();
    }

    /**
     * Return the class full name. Ex: User::class or "App\Entities\User";
     *
     * @return string
     */
    abstract protected function getModelClass(): string;
}