<?php namespace App\Console\Commands;

use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class UserCreateCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'user:create';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a User.';

    /**
     * @var Registrar
     */
    private $registrar;

    /**
     * @var Password
     */
    protected $password;

    /**
     * @var Password Confirmation
     */
    protected $password_confirmation;

    /**
     * @var Email
     */
    protected $email;

    /**
     * Create a new command instance.
     *
     * @param Registrar $registrar
     */
	public function __construct(Registrar $registrar)
	{
		parent::__construct();

        $this->registrar = $registrar;
    }

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        $credentials = $this->getCredentials();

        $validator = $this->registrar->validator($credentials);

        if($validator->fails())
        {
            return $this->displayErrors($validator->errors());
        }

        $this->registrar->create($credentials);

        $this->info('User created!');
	}

    /**
     * Get the email address and the password and
     * ask the user if there are none provided.
     *
     * @return array
     */
    public function getCredentials()
    {
        $this->email = $this->argument('email');

        $this->password = $this->option('password') ? $this->option('password') : $this->secret('Password ?');

        $this->password_confirmation = $this->option('password_confirmation') ? $this->option('password_confirmation') : $this->secret('Please confirm the password:');

        return [
            'email'                 => $this->email,
            'password'              => $this->password,
            'password_confirmation' => $this->password_confirmation,
        ];
    }

    /**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
            ['email', InputArgument::REQUIRED, 'E-Mail Address']
		];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
            ['password', null, InputOption::VALUE_OPTIONAL, 'Password', null],
            ['password_confirmation', null, InputOption::VALUE_OPTIONAL, 'Password Confirmation', null],
		];
	}

    /**
     * Display the errors to the console.
     *
     * @param $errors
     *
     * @return void
     */
    private function displayErrors($errors)
    {
        foreach($errors->all() as $error) {

            $this->error($error);
        }
    }

}
