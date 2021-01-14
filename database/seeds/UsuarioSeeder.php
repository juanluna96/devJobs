<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Juan Diego',
            'email' => 'juandluna17@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('juandluna17'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('users')->insert([
            'name' => 'Juan Luna',
            'email' => 'juandluna96@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('juandluna17'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
