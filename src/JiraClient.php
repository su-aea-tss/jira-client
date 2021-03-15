<?php

namespace SUTSS\JiraClient;

use SUTSS\JiraClient\HttpClient\GuzzleClient;
use SUTSS\JiraClient\Request\Issue;

/**
 * Description of JiraClient
 *
 * @author rastor
 */
class JiraClient
{

    const ENDPOINT_PATH = '/rest/api/2';

    private $credential;
    private $endpoint;

    /**
     *
     * @var Issue
     */
    private $issueRequest;

    /**
     *
     * @var \JiraClient\HttpClient\AbstractClient
     */
    private $httpClient;

    public function __construct()
    {
        $this->endpoint = 'https://ot.syr.edu' . self::ENDPOINT_PATH;
        $this->credential = new Credential(env('JIRA_LOGIN'), env('JIRA_PASSWORD'));
        $this->httpClient = new HttpClient\GuzzleClient();
    }

    /**
     *  api/2/issue - https://docs.atlassian.com/software/jira/docs/api/REST/8.5.1/#api/2/issue-getIssue
     * @param $issue
     * @param bool $expandFields
     * @return mixed
     */
    public function getIssue($issue, $expandFields = false)
    {
        $params = array();
        if ($expandFields) {
            $params['expand'] = '';
        }

        $path = "/issue/$issue" . http_build_query($params);
        return $this->callGet($path)->getData();
    }

    /**
     *
     * @return Issue
     */
    public function issue()
    {
        if ($this->issueRequest === null) {
            $this->issueRequest = new Request\Issue($this);
        }

        return $this->issueRequest;
    }

    public function call($method, $path, $data = array())
    {
        return $this->httpClient->sendRequest($method, $this->endpoint . $path, $data, $this->credential);
    }

    public function callPost($path, $data = array())
    {
        return $this->call(Request\AbstractRequest::METHOD_POST, $path, $data);
    }

    public function callGet($path, $data = array())
    {
        return $this->call(Request\AbstractRequest::METHOD_GET, $path, $data);
    }

    public function callPut($path, $data = array())
    {
        return $this->call(Request\AbstractRequest::METHOD_PUT, $path, $data);
    }

    public function callDelete($path, $data = array())
    {
        return $this->call(Request\AbstractRequest::METHOD_DELETE, $path, $data);
    }

}
