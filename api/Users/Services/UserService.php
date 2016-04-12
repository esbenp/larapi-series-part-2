<?php

namespace Api\Users\Services;

use Illuminate\Events\Dispatcher;
use Api\Exceptions\UserNotFoundException;
use Api\Events\UserWasCreated;
use Api\Events\UserWasDeleted;
use Api\Events\UserWasUpdated;
use Api\Users\Repositories\UserRepository;

class UserService
{
    private $dispatcher;

    private $userRepository;

    public function __construct(Dispatcher $dispatcher, UserRepository $userRepository)
    {
        $this->dispatcher = $dispatcher;
        $this->userRepository = $userRepository;
    }

    public function getAll($options = [])
    {
        return $this->userRepository->get($options);
    }

    public function getById($userId, array $options = [])
    {
        $user = $this->getRequestedUser($userId);

        return $user;
    }

    public function create($data)
    {
        $user = $this->userRepository->create($data);

        $this->dispatcher->fire(new UserWasCreated($user));

        return $user;
    }

    public function update($userId, array $data)
    {
        $user = $this->getRequestedUser($userId);

        $this->userRepository->update($user, $data);

        $this->dispatcher->fire(new UserWasUpdated($user));

        return $user;
    }

    public function delete($userId, array $data)
    {
        $user = $this->getRequestedUser($userId);

        $this->userRepository->delete($user, $data);

        $this->dispatcher->fire(new UserWasDeleted($user));
    }

    private function getRequestedUser($userId)
    {
        $user = $this->userRepository->getById($userId);

        if (is_null($user)) {
            throw new UserNotFoundException();
        }

        return $user;
    }
}
