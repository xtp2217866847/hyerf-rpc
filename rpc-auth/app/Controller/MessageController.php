<?php


namespace App\Controller;

use App\Service\ElasticsearchService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;

/**
 * @Controller()
 * Class MessageController
 * @package App\Controller
 */
class MessageController extends AbstractController
{

    /**
     * @Inject()
     * @var ElasticsearchService
     */
    protected $es;

    /**
     * @RequestMapping(path="/es/create")
     */
    public function create()
    {
        $params = [
            'index' => 'xp_index',
            'type'  => 'xp_type',
            'id'    => 'xp_id',
            'body'  => [
                'name' => 'xtp',
                'age'  => 24,
                'desc' => 'Elasticsearch 是一个分布式可扩展的实时搜索和分析引擎,一个建立在全文搜索引擎 Apache Lucene(TM) 基础上的搜索引擎.当然 Elasticsearch 并不仅仅是 Lucene 那么简单，它不仅包括了全文搜索功能，还可以进行以下工作'
            ]
        ];
        return $this->es->client->index($params);
    }

    /**
     * @RequestMapping(path="/es/get")
     */
    public function get()
    {
        $params = [
            'index' => 'xp_index',
            'type'  => 'xp_type',
            'id'    => 'xp_id',
        ];
        return $this->es->client->get($params);
    }

    /**
     * @RequestMapping(path="/es/search")
     */
    public function search()
    {
        $params = [
            'index' => 'xp_index',
            'type'  => 'xp_type',
            'body' => [
                'query' => [
                    'bool' => [
                        'must' => [
                            ["match" => ['name' => 'xtp']],
                            ["match" => ['age' => 24]]
                        ],
                    ]
                ]
            ]
        ];
        return $this->es->client->search($params);
    }

    /**
     * @RequestMapping(path="/es/delete")
     */
    public function delete()
    {
        $params = [
            'index' => 'xp_index',
            'type'  => 'xp_type',
            'id'    => 'xp_id',
        ];
        return $this->es->client->delete($params);
    }
}