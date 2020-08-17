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
            'index' => 'xtp_index',
            'body' => [
                'settings' => [
                    'number_of_shards' => 3,
                    'number_of_replicas' => 2
                ],
                'mappings' => [
                    'properties' => [
                        'name' => [
                            'type' => 'text'
                        ],
                        'age' => [
                            'type' => 'integer'
                        ],
                        'desc' => [
                            'type' => 'text',
                            'analyzer' => 'ik_max_word'
                        ],
                    ]
                ]
            ]
        ];
        return $this->es->client->indices()->create($params);
    }

    /**
     * @RequestMapping(path="/es/index")
     */
    public function index()
    {
        $params = [
            'index' => 'xtp_index',
            //'type'  => 'xtp_type',
            'id'    => 'xtp_id',
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
            'index' => 'xtp_index',
            //'type'  => 'xp_type',
            'id'    => 'xtp_id',
        ];
        return $this->es->client->get($params);
    }

    /**
     * @RequestMapping(path="/es/search")
     */
    public function search()
    {
        $params = [
            'index' => 'xtp_index',
            //'type'  => 'xp_type',
            'body' => [
                'query' => [
                    "match" => ['desc' => '分布式 搜索'],
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

    /**
     * @RequestMapping(path="/es/destroy")
     */
    public function destroy()
    {
        $params = ['index' => 'xtp_index'];
        return $this->es->client->indices()->delete($params);
    }
}