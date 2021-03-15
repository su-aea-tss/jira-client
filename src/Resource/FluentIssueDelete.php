<?php

namespace SUTSS\JiraClient\Resource;

use SUTSS\JiraClient\JiraClient,
    SUTSS\JiraClient\Resource\Issue,
    SUTSS\JiraClient\Exception\JiraException;

/**
 * Description of FluentIssueCreate
 *
 * @author rastor
 */
class FluentIssueDelete
{

    /**
     *
     * @var JiraClient
     */
    private $issue;

    public function __construct(Issue $issue)
    {
        $this->issue = $issue;
    }

    public function execute()
    {
        $data = array();

        try {
            $this->issue->getClient()->callDelete('/issue/' . $this->issue->getKey(), $data)->getData();
        } catch (\Exception $e) {
            throw new JiraException("Failed to delete issue", $e);
        }
    }
}
