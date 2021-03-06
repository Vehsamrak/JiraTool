<?php

namespace Vehsamrak\Jiratool\Service;

use GuzzleHttp\Client;

/**
 * @author Vehsamrak
 */
class JiraClient
{

    /** @var Client */
    private $client;

    /** @var string */
    private $username;

    /** @var string */
    private $password;

    /** @var string */
    private $jiraUrl;

    /** @var bool */
    private $verifySSL;

    public function __construct(
        string $username,
        string $password,
        string $jiraUrl,
        bool $verifySSL = true,
        Client $client = null
    ) {
        $this->client = $client ?? new Client();
        $this->username = $username;
        $this->password = $password;
        $this->jiraUrl = $jiraUrl;
        $this->verifySSL = $verifySSL;
    }

    public function searchByJQL(string $jql)
    {
        $apiResource = 'search?jql=' . $jql;

        return $this->sendGetRequest($apiResource);
    }

    private function sendGetRequest(string $apiResource): array
    {
        $options = [
            'verify' => $this->verifySSL,
        ];

        if ($this->username && $this->password) {
            $options['auth'] = [
                $this->username,
                $this->password,
            ];
        }


        $response = $this->client->request(
            'GET',
            $this->jiraUrl . $apiResource,
            $options
        );

        return json_decode($response->getBody()->getContents(), true);
    }
}
