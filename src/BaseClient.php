<?php


namespace BaseClient;


use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;

abstract class BaseClient {

    /**
     * @var Client
     */
    protected $transport;



    /**
     * BaseClient constructor.
     *
     * @param Client $transport
     */
    public function __construct(Client $transport) {
        $this->transport = $transport;
    }



    /**
     * @param $method
     * @param $uri
     * @param array $headers
     * @param null $body
     * @param string $version
     *
     * @return Request
     */
    protected function request($method, $uri, array $headers = [], $body = null, $version = '1.1') : Request {
        return new Request($method, $uri, $headers, $body, $version);
    }



    /**
     * @param Request $request
     * @param array $options
     *
     * @return string
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function getBody(Request $request, array $options = []) : string {
        $response = $this->transport->send($request, $options);

        $content = $response->getBody()->getContents();
        $this->exceptions($response, $content);

        return $content;
    }



    /**
     * @param ResponseInterface $response
     * @param string|null $content
     */
    abstract protected function exceptions(ResponseInterface $response, string $content = null) : void;



}
