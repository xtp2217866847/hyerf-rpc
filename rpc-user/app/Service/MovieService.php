<?php


namespace App\Service;

use App\Model\Movie;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Swoole\Coroutine\Http\Client;

/**
 * @Controller()
 * Class MovieService
 * @package App\Service
 */
class MovieService
{
    /**
     * @Inject()
     * @var Movie
     */
    private $movie;

    function reptile()
    {

    }
}