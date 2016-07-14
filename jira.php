<?php

require __DIR__ . '/vendor/autoload.php';

const ROOT_DIRECTORY = __DIR__;

use Symfony\Component\Console\Application;
use Vehsamrak\Jiratool\Command\SearchIssuesCommand;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Vehsamrak\Jiratool\Service\Config;
use Vehsamrak\Jiratool\Service\JiraClient;

$config = new Config();

$container = new ContainerBuilder();

$container->register('jira_client', JiraClient::class)
    ->addArgument($config->get('jira_username'))
    ->addArgument($config->get('jira_password'))
    ->addArgument($config->get('jira_url'));

$application = new Application();
$application->add(new SearchIssuesCommand($container));
$application->run();
