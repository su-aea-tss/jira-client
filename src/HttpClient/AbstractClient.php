<?php

namespace SUTSS\JiraClient\HttpClient;

use SUTSS\JiraClient\Response,
    SUTSS\JiraClient\Credential;

/**
 * Description of GuzzleClient
 *
 * @author rastor
 */
abstract class AbstractClient
{

    /**
     * @return Response
     */
    public abstract function sendRequest($method, $url, $data, Credential $credential);
}
