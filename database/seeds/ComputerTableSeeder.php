<?php

use App\Computer;
use DB;
use Illuminate\Database\Seeder;

class ComputerTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('computers')->delete();

        Computer::create([
            'name' 		   => 'npwi002',
            'mac' 		    => 'E8:2A:EA:E2:D0:60',
            'ip' 		     => '192.168.2.134',
            'broadcast' => '192.168.2.255',
            'subnet' 	  => '255.255.255.0',
        ]);

        Computer::create([
            'name' 		   => 'Netzi Lapi',
            'mac' 		    => 'E0:18:77:12:BD:3F',
            'ip' 		     => '192.168.2.141',
            'broadcast' => '192.168.2.255',
            'subnet' 	  => '255.255.255.0',
        ]);
    }
}
