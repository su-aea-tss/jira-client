<?php


namespace SUTSS\JiraClient\Facades;

/**
 * @method static \SUTSS\JiraClient\JiraClient issue($type, $method, $params)
 * @method static \SUTSS\JiraClient\JiraClient getIssue($issue, $expandFields = false)
 *
 */
class JiraClient extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        return 'jiraclient';
    }
}
