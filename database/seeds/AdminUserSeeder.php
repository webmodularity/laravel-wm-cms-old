<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $personId = DB::table('people')->insertGetId([
            'email' => 'rory@webmodularity.com',
        ]);

        $socialProviderId = DB::table('user_social_providers')->insertGetId([
            'slug' => 'github',
        ]);

        DB::table('user_invitations')->insert([
            'social_provider_id' => $socialProviderId,
            'person_id' => $personId,
            'role_id' => 255,
            'status' => 1
        ]);
    }
}
