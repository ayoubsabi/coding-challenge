<?php

namespace App\Services\User;

use Exception;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use App\Services\Utils\ValidatorService;
use Illuminate\Contracts\Pagination\Paginator;

class UserService
{
    private $userRepository;
    private $validatorService;

    public function __construct(UserRepository $userRepository, ValidatorService $validatorService)
    {
        $this->userRepository = $userRepository;
        $this->validatorService = $validatorService;
    }

    /**
     * @method loginCheck(int $id)
     *
     * @param array $data
     *
     * @return User|null
     */
    public function loginCheck(array $data = []): ?User
    {
        $data = $this->validatorService->validate($data, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = $this->userRepository->findOneBy(['email' => $data['email']]);

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            return null;
        }

        return $user;
    }

    /**
     * @method getUsers(array $criteria, array $orderBy)
     *
     * @param array $criteria
     * @param array $orderBy
     *
     * @return Paginator
     */
    public function getUsers(array $criteria = [], array $orderBy = []): Paginator
    {
        $criteria = $this->validatorService->validate($criteria, [
            'name' => 'string',
            'email' => 'string',
        ]);

        $orderBy = $this->validatorService->validate($orderBy, [
            'name' => 'in:asc,desc',
            'created_at' => 'in:asc,desc'
        ]);

        return $this->userRepository->findBy($criteria, $orderBy);
    }

    /**
     * @method getUserById(int $id)
     *
     * @param int $id
     *
     * @return User|null
     */
    public function getUserById(int $id): ?User
    {
        return $this->userRepository->findOneBy(['id' => $id]);
    }

    /**
     * @method createUser(array $data)
     *
     * @param array $data
     *
     * @return User
     */
    public function createUser(array $data): User
    {
        $data = $this->validatorService->validate($data, [
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        return $this->userRepository->create($data);
    }

    /**
     * @method updateUser(User $user, array $data)
     *
     * @param User $user
     * @param array $data
     *
     * @return User
     */
    public function updateUser(User $user, array $data): User
    {
        $data = $this->validatorService->validate($data, [
            'name' => 'string',
            'email' => 'string',
            'password' => 'string|confirmed'
        ]);

        throw_if(
            ! $this->userRepository->update($user, $data),
            new Exception("User update failure")
        );

        return $this->userRepository->findOneBy(['id' => $user->id]);
    }

    /**
     * @method deleteUser(User $user)
     *
     * @param User $user
     *
     * @return void
     */
    public function deleteUser(User $user): void
    {
        throw_if(
            ! $this->userRepository->delete($user),
            new Exception("User delete failure")
        );
    }
}
