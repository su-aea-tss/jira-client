<?php

namespace SUTSS\JiraClient\Request;

use SUTSS\JiraClient\JiraClient;

/**
 * Description of AbstractRequest
 *
 * @author rastor
 */
class AbstractRequest
{

    const METHOD_GET = 'GET';
    const METHOD_PUT = 'PUT';
    const METHOD_POST = 'POST';
    const METHOD_DELETE = 'DELETE';

    protected $client;

    public function __construct(JiraClient $client)
    {
        $this->client = $client;
    }

    public function getClient()
    {
        return $this->client;
    }

}
