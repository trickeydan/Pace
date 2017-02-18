<?php

namespace App\Console;


use App\System;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PaceCommand extends Command
{
    /**
     * Title of the application
     */
    protected $title = 'PACE Command';

    /**
     *
     */
    protected function confirmContinue(){
        if(!$this->confirm('Are you sure you want to continue?')){
            $this->error('Action cancelled by user');
            exit();
        }
    }

    /**
     *
     */
    protected function requireGSP(){
        $attempt = $this->secret('Please provide the general system password to continue.');
        if(!System::checkGeneralSystemPassword($attempt)){
            $this->error('Incorrect general system password');
            exit();
        }
    }

    /**
     * Execute the console command.
     *
     * @param  \Symfony\Component\Console\Input\InputInterface  $input
     * @param  \Symfony\Component\Console\Output\OutputInterface  $output
     * @return mixed
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $method = method_exists($this, 'handle') ? 'handle' : 'fire';
        $this->info('PACE Points System v' . config('app.version'));
        $this->info('GNU Public Licence Version 3 (GPLv3)');
        $this->info('Copyright ' . date('Y') . ' ' . config('app.author'));
        $this->info('');
        $this->info($this->title);
        return $this->laravel->call([$this, $method]);
    }

    /**
     * Kill with a message.
     *
     * @param $message
     */
    protected function kill($message){
        $this->error($message);
        exit();
    }
}