<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Subscriber;

class SubscribersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::connection()->getDriverName() == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }

        if (DB::connection()->getDriverName() == 'mysql') {
            DB::table('subscribers')->truncate();
        } elseif (DB::connection()->getDriverName() == 'sqlite') {
            DB::statement('DELETE FROM  subscribers');
        } else {
            //For PostgreSQL or anything else
            DB::statement('TRUNCATE TABLE  subscribers CASCADE');
        }

        $faker = \Faker\Factory::create();

        $state = array('active', 'unsubscribed', 'junk', 'bounced', 'unconfirmed');

        // And now, let's create a few subscriber in our database:
        for ($i = 0; $i < 20; $i++) {
        	// get random index from $state array
			$randIndex = array_rand($state);

            Subscriber::create([
                'name' => $faker->name,
                'email_address' => $faker->email,
                'state' => $state[$randIndex],
            ]);
        }

        if (DB::connection()->getDriverName() == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }

    }
}
