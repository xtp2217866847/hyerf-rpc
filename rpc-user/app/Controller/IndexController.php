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

use App\Service\MovieService;
use App\Service\UserService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\HttpServer\Contract\RequestInterface;

/**
 * @Controller()
 * Class IndexController
 * @package App\Controller
 */
class IndexController extends AbstractController
{

    /**
     * @Inject()
     * @var UserService
     */
    private $userService;

    /**
     * @Inject()
     * @var MovieService
     */
    private $movieService;

    /**
     * @RequestMapping(path="user", methods="get")
     * @param RequestInterface $request
     * @return array
     */
    public function index(RequestInterface $request)
    {
        return $this->userService->getUserById((int)$request->input('id'))->toArray();
    }

    /**
     * @RequestMapping(path="reptile", methods="get")
     * @return mixed
     */
    public function reptile()
    {
        return $this->movieService->reptile();
    }
}
