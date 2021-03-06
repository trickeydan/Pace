<?php

namespace App\Console;


use App\Exceptions\PaceException;
use App\System;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Carbon\Carbon;

class PaceCommand extends Command
{
    /**
     * Title of the application
     *
     * @var $title
     */
    protected $title = 'PACE Command';

    /**
     * Confirm if the user would like to continue.
     *
     * @return void
     */
    protected function confirmContinue(){
        if(!$this->confirm('Are you sure you want to continue?')){
            $this->error('Action cancelled by user');
            exit();
        }
    }

    /**
     * Ask for and check the general system password.
     *
     * @return void
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
     * Same as the parent class, but I have added introductory and title text.
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
        $this->info('');

        return $this->laravel->call([$this, $method]);
    }

    /**
     * Kill with a message.
     *
     * Kill the current command and display an error message.
     *
     * @param $message
     */
    public function kill($message){
        $this->error($message);
        die();
    }

    /**
     * Put up a maintenance message.
     *
     * @param $message
     */
    protected function down($message){
        file_put_contents(
            $this->laravel->storagePath().'/framework/down',
            json_encode($this->getDownFilePayload($message), JSON_PRETTY_PRINT)
        );
    }

    /**
     * Get the payload to be placed in the "down" file.
     *
     * @return array
     */
    protected function getDownFilePayload($message)
    {
        return [
            'time' => Carbon::now()->getTimestamp(),
            'message' => $message,
            'retry' => null,
        ];
    }

    /**
     * Override protected property to get progressbar instance.
     *
     * @param $count
     * @return mixed
     */
    public function createProgressBar($count){
        return $this->output->createProgressBar($count);
    }
}