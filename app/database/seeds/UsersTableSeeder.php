<?php

class UsersTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
    public function run()
    {
        // DB::table('users')->delete(); // only deletes all records from table. that's a problem because the auto incrementing id will not reset to 1.

        // Calling appropriate migration directly
        $ut = new CreateUsersTable;
        $ut->down();
        $ut->up();

        User::create(array(
            'fname'     => 'Riddhi',
            'lname'     => 'Mittal',
            'mobile'    => 9873574130,
            'password'  => Hash::make('9873574130'),
            'age'       => 34,
            'email'    => 'riddhi.mittal1@gmail.com',
        ));
    }

}
