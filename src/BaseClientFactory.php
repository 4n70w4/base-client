<?php


namespace BaseClient;


use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class BaseClientFactory {

    /**
     * @param $base_uri
     * @param bool $http_errors
     * @param array $config
     *
     * @return Client
     */
    public function getClient($base_uri, $http_errors = false, array $config = []) {
        return new Client(['base_uri' => $base_uri, RequestOptions::HTTP_ERRORS => $http_errors] + $config);
    }



}