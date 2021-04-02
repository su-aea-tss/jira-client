<?php


namespace SUTSS\JiraClient\Facades;

/**
 * @method static \SUTSS\JiraClient\JiraClient issue($type, $method, $params)
 * @method static \SUTSS\JiraClient\JiraClient createIssue($summary,$description,$reporter = null)
 * @method static \SUTSS\JiraClient\JiraClient getIssue($issue, $expandFields = false)
 * @method static \SUTSS\JiraClient\JiraClient closeIssue($issue)
 * @method static \SUTSS\JiraClient\JiraClient getTransitions($issue)
 * @method static \SUTSS\JiraClient\JiraClient search($jql)
 *
 */
class JiraClient extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        return 'jiraclient';
    }
}
