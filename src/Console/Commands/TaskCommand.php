<?php namespace Bantenprov\Task\Console\Commands;

use Illuminate\Console\Command;

/**
 * The TaskCommand class.
 *
 * @package Bantenprov\Task
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class TaskCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bantenprov:task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Demo command for Bantenprov\Task package';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Welcome to command for Bantenprov\Task package');
    }
}
