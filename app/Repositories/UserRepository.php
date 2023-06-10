<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;
use App\Repositories\BaseRepository\ModelRepository;

/**
 * @method User|null    findOneBy(array $criteria = [], array $columns = ['*'])
 * @method Paginator    findBy(array $criteria = [], array $orderBy = [], int $itemPerPage = 10, array $columns = ['*'])
 * @method Paginator    findAll(array $orderBy = [], int $itemPerPage = 10, array $columns = ['*'])
 */
class UserRepository extends ModelRepository
{
    public function __construct()
    {
        parent::__construct(User::class);
    }

    /**
     * @method create(array $data)
     *
     * @param array $data
     *
     * @return User
     */
    public function create(array $data): User
    {
        return User::create($data);
    }

    /**
     * @method update(User $user, array $data)
     *
     * @param User $user
     * @param array $data
     *
     * @return bool
     */
    public function update(User $user, array $data): bool
    {
        return $user->update($data);
    }

    /**
     * @method delete(User $user)
     *
     * @param User $user
     *
     * @return bool
     */
    public function delete(User $user): bool
    {
        return $user->delete();
    }
}
