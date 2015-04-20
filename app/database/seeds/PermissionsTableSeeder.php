<?php

class PermissionsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('permissions')->delete();

        $permissions = array(
            array( // 1
                'name'         => 'manage_candidate',
                'display_name' => '管理候选人'
            ),
            array( // 2
                'name'         => 'manage_team',
                'display_name' => '管理团队'
            ),
            array( // 3
                'name'         => 'manage_project',
                'display_name' => '管理项目'
            ),
            array( // 4
                'name'         => 'manage_positions',
                'display_name' => '管理职位'
            ),
            array( // 5
                'name'         => 'manage_clients',
                'display_name' => '管理客户'
            ),
            array( // 6
                'name'         => 'manage_companys',
                'display_name' => '管理公司'
            ),
            array( // 7
                'name'         => 'manage_users',
                'display_name' => '管理用户'
            ),
            array( // 8
                'name'         => 'manage_roles',
                'display_name' => '管理权限'
            )
        );

        DB::table('permissions')->insert( $permissions );

        DB::table('permission_role')->delete();
        $role_id_admin = Role::where('name', '=', 'user_admin')->first()->id;
        $role_id_leader = Role::where('name', '=', 'user_leader')->first()->id;
        $role_id_member = Role::where('name', '=', 'user_member')->first()->id;
        $permission_base = (int)DB::table('permissions')->first()->id - 1;

        $permissions = array(
            // admin
            array(
                'role_id'       => $role_id_admin,
                'permission_id' => $permission_base + 1
            ),
            array(
                'role_id'       => $role_id_admin,
                'permission_id' => $permission_base + 2
            ),
            array(
                'role_id'       => $role_id_admin,
                'permission_id' => $permission_base + 3
            ),
            array(
                'role_id'       => $role_id_admin,
                'permission_id' => $permission_base + 4
            ),
            array(
                'role_id'       => $role_id_admin,
                'permission_id' => $permission_base + 5
            ),
            array(
                'role_id'       => $role_id_admin,
                'permission_id' => $permission_base + 6
            ),

            array(
                'role_id'       => $role_id_admin,
                'permission_id' => $permission_base + 7
            ),

            array(
                'role_id'       => $role_id_admin,
                'permission_id' => $permission_base + 8
            ),
            // leader
           array(
                'role_id'       => $role_id_leader,
                'permission_id' => $permission_base + 1
            ),
            array(
                'role_id'       => $role_id_leader,
                'permission_id' => $permission_base + 2
            ),
            array(
                'role_id'       => $role_id_leader,
                'permission_id' => $permission_base + 3
            ),
            array(
                'role_id'       => $role_id_leader,
                'permission_id' => $permission_base + 4
            ),
            array(
                'role_id'       => $role_id_leader,
                'permission_id' => $permission_base + 5
            ),
            array(
                'role_id'       => $role_id_leader,
                'permission_id' => $permission_base + 6
            ),
            // member
            array(
                'role_id'       => $role_id_member,
                'permission_id' => $permission_base + 1
            )
        );

        DB::table('permission_role')->insert( $permissions );
    }

}