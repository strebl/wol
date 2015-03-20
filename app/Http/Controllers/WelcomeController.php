<?php namespace App\Http\Controllers;

use \Phpwol\Factory as Phpwol;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	private $phpwol;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(Phpwol $phpwol)
	{
		$this->middleware('guest');

		$this->phpwol = $phpwol;
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$magicPacket = $this->phpwol->magicPacket();

		/*$macAddress = 'E8:2A:EA:E2:D0:60';
		$ip = '192.168.2.134';

		$macAddress = 'E0:18:77:12:BD:3F';
		$ip = '192.168.2.141';

		$subnet = '255.255.255.0';

		$result = $magicPacket->send($macAddress, $ip, $subnet);*/

		$macAddress = 'E8:2A:EA:E2:D0:60';
		$ip = '192.168.2.255';

		$subnet = '255.255.255.0';

		$result = $magicPacket->send($macAddress, $ip);

		if ($result){
		  return "Worked\n";
		} else {
		  return "Failed\n";
		}
	}

}
