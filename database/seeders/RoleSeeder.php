<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Role::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $permissions = [];
        foreach(config('permissions_en') as $permission => $value){
            $permissions[] = $permission;
        }

        Role::create([
            'role'=>[
                'ar'=>'مدير',
                'en'=>'Manger',
            ],
            'permissions'=> $permissions,
        ]);
    }
}
