<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Controller;

use App\Rpc\UserServiceInterface;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Di\Aop\ProceedingJoinPoint;
use Hyperf\Di\Exception\Exception;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\Middleware;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\RateLimit\Annotation\RateLimit;

/**
 * @Controller(prefix="rate-limit")
 * @//RateLimit(limitCallback={"App\Controller\IndexController::getUserByIdLimitBack"})
 * Class IndexController
 * @package App\Controller
 */
class IndexController extends AbstractController
{
    /**
     * @Inject()
     * @var UserServiceInterface
     */
    private $userService;

    /**
     * @RequestMapping(path="")
     * @RateLimit(create=1, consume=1, capacity=2)
     * @return mixed
     */
    public function index()
    {
        return $this->userService->getUserById(1);
    }

    /**
     * 服务限流失败回调
     *
     * @param float $seconds
     * @param ProceedingJoinPoint $proceedingJoinPoint
     * @return array
     * @throws Exception
     */
    public static function getUserByIdLimitBack(float $seconds, ProceedingJoinPoint $proceedingJoinPoint)
    {
        return ["请1s稍后重试"];
        return $proceedingJoinPoint->process();
    }
}
