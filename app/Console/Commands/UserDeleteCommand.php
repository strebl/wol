<?php namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class UserDeleteCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'user:delete';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Delete a user.';

    /**
     * @var User
     */
    private $user;

    /**
     * Create a new command instance.
     *
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
	public function fire()
	{
		if($this->userExists())
        {
            if($this->confirm('Are you sure? [yes|no]', true))
            {
                $this->user()->delete();
                
                return $this->info('User deleted!');
            }

            return $this->info('Did nothing!');
        }

        return $this->error('Did not find a user with this mail address. Try Again!');
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
			['email', InputArgument::REQUIRED, 'The Email Address of the user.'],
		];
	}

    /**
     * Return if the user exists
     *
     * @return bool
     */
    private function userExists()
    {
        return (bool) $this->user();
    }

    /**
     * Get the user
     *
     * @return mixed
     */
    private function user()
    {
        if(! $this->user)
        {
            $this->user = User::whereEmail($this->argument('email'))->first();
        }

        return $this->user;
    }

}
