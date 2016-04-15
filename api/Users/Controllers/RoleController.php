<?php

namespace Api\Users\Controllers;

use Illuminate\Http\Request;
use Infrastructure\Http\Controller;
use Api\Users\Requests\CreateRoleRequest;
use Api\Users\Services\RoleService;

class RoleController extends Controller
{
    private $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function getAll()
    {
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->roleService->getAll($resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'roles');

        return $this->response($parsedData);
    }

    public function getById($userId)
    {
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->roleService->getById($userId, $resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'role');

        return $this->response($parsedData);
    }

    public function create(CreateRoleRequest $request)
    {
        $data = $request->get('role', []);

        return $this->response($this->roleService->create($data), 201);
    }

    public function update($roleId, Request $request)
    {
        $data = $request->get('role', []);

        return $this->response($this->roleService->update($userId, $data));
    }

    public function delete($roleId)
    {
        return $this->response($this->roleService->delete($roleId));
    }
}
