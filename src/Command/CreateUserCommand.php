<?php

namespace App\Command;

use App\Entity\User;
use App\Service\createUser;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;

class CreateUserCommand extends Command
{
    protected static $defaultName = 'app:create-user';

    private $createUser;

    public function __construct()
    {
        //$this->createUser = $createUser;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Add User from command');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');
        $io = new SymfonyStyle($input, $output);

        $question = new Question('Please enter the first_name: ');
        $io->askQuestion($question);
        $question->setValidator(function ($answer) {
            if (!preg_match('/^[a-z ,.\'-]+$/i', $answer, $find)) {
                throw new \RuntimeException(
                    'please enter a valid first name'
                );
            }
            return $answer;
        });
        $firstName = $helper->ask($input, $output, $question);
        $question = new Question('Please enter the last_name: ');
        $question->setValidator(function ($answer) {
            if (!preg_match('/^[a-z ,.\'-]+$/i', $answer, $find)) {
                throw new \RuntimeException(
                    'please enter a valid last name'
                );
            }
            return $answer;
        });
        $lastName = $helper->ask($input, $output, $question);
        $question = new Question('Please enter the email: ');
        $question->setValidator(function ($answer) {
            if (!preg_match('/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/ ', $answer, $find)) {
                throw new \RuntimeException(
                    'please enter a valid email'
                );
            }
            return $answer;
        });
        $email = $helper->ask($input, $output, $question);
        $question = new Question('Please enter the password: ');
        $question->setValidator(function ($answer) {
            if (!preg_match('/^.{6,}$/', $answer, $find)) {
                throw new \RuntimeException(
                    'please enter a valid password (at least 6 chars)'
                );
            }
            return $answer;
        });
        $password = $helper->ask($input, $output, $question);

        $question = new Question('Is he admin? [yes/no]: ');
        $admin = $helper->ask($input, $output, $question);

        //$this->createUser->create($firstName, $lastName, $email, $password, $admin);

        $io->success('The user has been created');

    }
}
