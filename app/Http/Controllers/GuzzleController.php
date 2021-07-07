<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Pool;
use GuzzleHttp\Promise;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;


class GuzzleController extends Controller
{
    //同步请求
    public function sync()
    {
        $client   = new Client();
        $response = $client->get('http://httpbin.org/get');
        dump($response);

        $request  = new Request('PUT', 'http://httpbin.org/put');
        $response = $client->send($request, ['timeout' => 2]);
        dump($response);
    }

    //异步请求
    public function async()
    {
        $headers = ['X-Foo' => 'Bar'];
        $body    = 'Hello!';
        $request = new Request('HEAD', 'http://httpbin.org/head', $headers, $body);
        dump($request);


        $client  = new Client();
        $promise = $client->requestAsync('GET', 'http://www.baidu.com');
        $promise->then(function (ResponseInterface $res) {
            echo $res->getStatusCode() . "\n";
            echo $res->getBody();
        }, function (RequestException $e) {
            echo $e->getMessage() . "\n";
            echo $e->getRequest()->getMethod();
        });
        dump('end');
        $promise->wait();

//        $client = new Client();
//        $request = new Request('GET', 'http://www.baidu.com');
//        $promise = $client->sendAsync($request)->then(function ($response) {
//            echo $response->getStatusCode();
//        });
//        dump('end');
//        $promise->wait();

    }

    //并发请求
    public function multi()
    {
        $client = new Client();

        //创建一个请求列表
        $promises = [
            'baidu'  => $client->getAsync('https://www.baidu.com'),
            'jd'     => $client->getAsync('https://www.jd.com'),
            'taobao' => $client->getAsync('https://www.taobao.com'),
        ];

        //等待所有请求完成
        $results = Promise\Utils::unwrap($promises);
        $baidu   = $results['baidu']->getStatusCode();
        $jd      = $results['jd']->getHeader('Content-Length');
        $taobao  = $results['taobao']->getStatusCode();
        dump($baidu);
        dump($jd);
        dump($taobao);
        $responses = Promise\Utils::settle($promises)->wait();
        dump($responses);

    }

    //并发池
    public function pool()
    {
        $client   = new Client();
        $requests = function ($total) {
            $uri = 'https://www.baidu.com';
            for ($i = 0; $i < $total; $i++) {
                yield new Request('GET', $uri);
            }
        };

        $pool    = new Pool($client, $requests(200), [
            'concurrency' => 10,
            'fulfilled'   => function (Response $response, $index) {
                // this is delivered each successful response
                echo 'success：' . $index . '---' . $response->getStatusCode() . "<br/>";
            },
            'rejected'    => function (RequestException $reason, $index) {
                // this is delivered each failed request
                echo 'failed：' . $index . '---' . $reason->getMessage() . "\n";

            },
        ]);
        $promise = $pool->promise();

        $promise->wait();
    }

    public function response()
    {
        $client = new Client();
        $uri    = 'http://baidu.com';

        $response = $client->request('GET', $uri);
        $headers  = $response->getHeaders();
        dump($headers);

        $body = $response->getBody();
//        echo $body;

        $stringBody = (string)$body;
        dump($stringBody);

//        dump($body->read(10));

//        dump($body->getContents());
    }

    public function param()
    {
        //1：查询字符串
        $client = new Client();
        $res    = $client->request('GET', 'http://baidu.com', [
            'query' => ['foo' => 'bar']
        ]);

        //2：上传数据
    }

    public function spider()
    {
        $client = new Client();
        $res = $client->request("POST", "http://baidu.om", [
            'headers' => [
                'Content-Type'=>'application/x-www-form-urlencoded',
                'Content-Length'=>96,
            ],
            'form_params'=>[
                "username" => 'admin',
                "password" => '123456',
            ],
        ]);
        $header = $res->getHeaders();
        dump($header);
        $a = $header['Set-Cookie'][0];
        dump($a);exit;
    }

    public function spider1()
    {
        $cookieJar = CookieJar::fromArray([
            'OSL_LOGINCOOKIE'=>'A1C2D9717953EEB3AF51A009E00B65F1DF1E4D60EECEAEE2279840FC025C4FD55AF31C7BB1011B0198A0652F36B46D12AEA10820AD76D39C1EAA54BB198C8B9D07FCB3B8E1D8E4562649F20DB65C71E2D419D85B6C296625A17DB1DCECB62318ED7FBBA0EC332DCC75A72E7DB3CA6456FFB31435F5074BE8CD39DFC2D8BAB52E5676DB66033A8CCCF4BECE2535B3599AAAC8B22FA76CD046B107D288AF3CF73D812C53B0B69B754098311EDBAED570EE71AEAA1F67762C64D249275DF2D92B56F8055F93C967E4465A0F9D14D379A6EF5AAD1FD37C06011DC701BDF181F2575F8B038E70A4C92D964722B2E48AB0A9C67A2388A4AEE1E77636E35F2A2E91E25BCD0EF9513DC1F03C3398DE62FF340BEA832C937703E898DA6730BB1D9E2F78BC8ABBCD991F229ED13FA8D01FC96B76611D65C9A872789CAC351F83871A94A95B9434D745F384DF38',
        ],'baidu.com');
        $client = new Client([
            'cookies' => $cookieJar,
        ]);
        $result = $client->get('http://baidu.com');

        $data =$result->getBody()->getContents();
        dump($data);
    }
}
