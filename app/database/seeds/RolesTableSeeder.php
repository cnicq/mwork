<?php

class RolesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('roles')->delete();

        $adminRole = new Role;
        $adminRole->name = 'user_admin';
        $adminRole->save();

        $leaderRole = new Role;
        $leaderRole->name = 'user_leader';
        $leaderRole->save();

        $memberRole = new Role;
        $memberRole->name = 'user_member';
        $memberRole->save();

        $user = User::where('username','=','admin')->first();
        $user->attachRole( $adminRole );

        //$user = User::where('username','=','user')->first();
        //$user->attachRole( $leaderRole );
    }

}
