<?php

class PermissionsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('permissions')->delete();


        $permissions = array(
            array(
                'name'      => 'manage_blogs',
                'display_name'      => 'manage blogs'
            ),
            array(
                'name'      => 'manage_settings',
                'display_name'      => 'manage settings'
            ),
            array(
                'name'      => 'manage_posts',
                'display_name'      => 'manage posts'
            ),
            array(
                'name'      => 'manage_comments',
                'display_name'      => 'manage comments'
            ),
            array(
                'name'      => 'manage_users',
                'display_name'      => 'manage users'
            ),
            array(
                'name'      => 'manage_roles',
                'display_name'      => 'manage roles'
            ),
            array(
                'name'      => 'post_comment',
                'display_name'      => 'post comment'
            ),
            array(
                'name'      => 'site_search',
                'display_name'      => 'site search'
            ),
            array(
                'name'      => 'manage_todos',
                'display_name'      => 'manage todos'
            ),
        );

        DB::table('permissions')->insert( $permissions );

        DB::table('permission_role')->delete();

        $permissions = array(
            array(
                'role_id'      => 1,
                'permission_id' => 1
            ),
            array(
                'role_id'      => 1,
                'permission_id' => 2
            ),
            array(
                'role_id'      => 1,
                'permission_id' => 3
            ),
            array(
                'role_id'      => 1,
                'permission_id' => 4
            ),
            array(
                'role_id'      => 1,
                'permission_id' => 5
            ),
            array(
                'role_id'      => 1,
                'permission_id' => 6
            ),
            array(
                'role_id'      => 1,
                'permission_id' => 7
            ),
            array(
                'role_id'      => 1,
                'permission_id' => 8
            ),
            array(
                'role_id'      => 1,
                'permission_id' => 9
            ),
            array(
                'role_id'      => 2,
                'permission_id' => 6
            ),
        );

        DB::table('permission_role')->insert( $permissions );
    }

}
