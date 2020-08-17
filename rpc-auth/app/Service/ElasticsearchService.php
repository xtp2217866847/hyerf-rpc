<?php


namespace App\Service;

use Elasticsearch\Client;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Di\Container;
use Hyperf\Elasticsearch\ClientBuilderFactory;
use Hyperf\HttpServer\Annotation\Controller;

/**
 * @Controller()
 * Class ElasticsearchService
 * @package App\Service
 */
class ElasticsearchService
{
    /**
     * @Inject()
     * @var Container
     */
    public $container;

    /**
     * @var Client
     */
    public $client;
    /**
     * ElasticsearchService constructor.
     */
    public function __construct()
    {
        $builder = $this->container->get(ClientBuilderFactory::class)->create();
        $this->client = $builder->setHosts(['elasticsearch:9200'])->build();
    }

}