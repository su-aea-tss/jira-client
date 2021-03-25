<?php

namespace SUTSS\JiraClient;

use SUTSS\JiraClient\HttpClient\GuzzleClient;
use SUTSS\JiraClient\Request\Issue;
use SUTSS\JiraClient\Resource\Field;

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
        $this->endpoint = 'https://'. env('JIRA_INSTANCE') . self::ENDPOINT_PATH;
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
        return $this->issue()->get($issue);
    }

    /**
     *
     */
    public function createIssue($summary,$description,$reporter = null)
    {
        return $this->issue()
            ->create(env('JIRA_PROJECT'), 'Task')
            ->field(Field::SUMMARY, $summary)
            ->field(Field::DESCRIPTION, $description)
//            ->field(Field::COMPONENT, 'Redirect Request') // Can't set this on dev for some reason
            ->field(Field::REPORTER, ($reporter) ? $reporter : env('JIRA_LOGIN'))
            ->execute();
    }

    /**
     *
     */
    public function getTransitions($key)
    {
        return $this->issue()->getTransitions($key);
    }

    /**
     *
     */
    public function closeIssue($key)
    {
        $issue = $this->issue()->get($key);
        return $issue->transition()->execute(2);
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
