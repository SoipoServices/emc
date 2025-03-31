<?php

namespace App\Console\Commands;

use App\Helpers\AddUserToEmailOctopusList;
use App\Models\User;
use Illuminate\Console\Command;


class AddUsersToMailingList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'octopus:add-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is used to add users to the mailing list';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all();
        $progressBar = $this->output->createProgressBar($users->count());
        $progressBar->start();

        $users->each(function($user) use ($progressBar){
            AddUserToEmailOctopusList::addContact($user);
            $progressBar->advance();
        });
        $progressBar->finish();
       
    }
}
