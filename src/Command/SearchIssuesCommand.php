<?php

namespace Vehsamrak\Jiratool\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Vehsamrak\Jiratool\Service\JiraClient;

/**
 * @author Vehsamrak
 */
class SearchIssuesCommand extends ContainerAwareCommand
{

    /** {@inheritDoc} */
    protected function configure()
    {
        $this->setName('issue:search');
        $this->setDescription('Search issues by Jira Query Language');
        $this->addArgument(
            'jql',
            InputArgument::REQUIRED,
            'JQL string'
        );
    }

    /** {@inheritDoc} */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $projectName = $input->getArgument('jql');

        /** @var JiraClient $jiraClient */
        $jiraClient = $this->get('jira_client');
        $result = $jiraClient->searchByJQL($projectName);

        $output->writeln($result);
    }
}
