<?php

use Illuminate\Database\Seeder;
use WebModularity\LaravelUser\UserSocialProvider;
use WebModularity\LaravelContact\Person;
use WebModularity\LaravelUser\UserInvitation;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $socialProvider = UserSocialProvider::where('slug', 'github')->first();
        $socialProvider->status = true;
        $socialProvider->save();

        $people = [];
        $superAdmins = [
            'rory@webmodularity.com'
        ];

        foreach ($superAdmins as $email) {
            $people[] = [
                'person' => Person::firstOrCreate(['email' => $email]),
                'role' => 255
            ];
        }

        foreach ($people as $user) {
            UserInvitation::create(
                [
                    'social_provider_id' => $socialProvider->id,
                    'person_id' => $user['person']->id,
                    'role_id' => $user['role'],
                    'status' => true
                ]
            );
        }
    }
}
