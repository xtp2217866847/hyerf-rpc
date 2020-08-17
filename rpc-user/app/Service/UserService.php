<?php

namespace App\Service;

use App\Model\User;
use App\Rpc\UserServiceInterface;
use Hyperf\CircuitBreaker\Annotation\CircuitBreaker;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\RpcServer\Annotation\RpcService;

/**
 * @Controller()
 * @RpcService(name="UserService", protocol="jsonrpc-http", server="jsonrpc-http" ,publishTo="consul")
 * Class UserService
 * @package App\Service
 */
class UserService implements UserServiceInterface
{
    /**
     * @Inject()
     * @var User
     */
    private $user;

    /**
     * @CircuitBreaker(timeout="1", failCounter=1, successCounter=1, fallback="App\Service\UserService::getUserByIdSimple")
     * @param int $id
     * @return array
     */
    public function getUserById(int $id)
    {
        return User::query()->find($id)->toArray();
    }

    /**
     * 服务熔断失败回调
     *
     * @param int $id
     * @return array
     */
    public function getUserByIdSimple(int $id)
    {
        return ['id' => $id, 'name' => 'xtp'];
    }
}