<?php

namespace App\Console;

use App\Service\UserService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:create-test-user',
    description: 'Creates a new test user.',
    aliases: ['app:create-test-user'],
    hidden: false
)]
class CreateUserCommand extends Command
{
    public function __construct(
        private readonly UserService $userService
    )
    {
        parent::__construct();
    }
    protected function configure(): void
    {
        $this
            ->setName('app:c:u')
            ->setDescription('Create test user');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->userService->createTestUser();

        return Command::SUCCESS;
    }
}