<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Field;

class FieldsTableSeeder extends Seeder
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
            DB::table('fields')->truncate();
        } elseif (DB::connection()->getDriverName() == 'sqlite') {
            DB::statement('DELETE FROM  fields');
        } else {
            //For PostgreSQL or anything else
            DB::statement('TRUNCATE TABLE  fields CASCADE');
        }

        $faker = \Faker\Factory::create();

        $type = array('date', 'number', 'string', 'boolean');

        // And now, let's create a few fileds in our database:
        for ($i = 0; $i < 20; $i++) {
        	// get random index from $type array
			$randIndex = array_rand($type);

            Field::create([
                'title' => $faker->sentence,
                'type' => $type[$randIndex],
            ]);
        }

        if (DB::connection()->getDriverName() == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}
