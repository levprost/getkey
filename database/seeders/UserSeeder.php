<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([ 
            'first_name'=>'Dada',
            'last_name'=>'NetNet',
            'pseudo' => 'User',
            'city' => 'ville',
            'adresse' => 'Rue',  
            'avatar' => 'user.png', 
            'role' => 'user',
            'password' => Hash::make('admin2024!'), 
            'email' => 'user@truc.fr', 
            'email_verified_at' => now(), 
            'remember_token' => Str::random(10), 
        ]); 
        User::create([ 
            'first_name'=>'Lev',
            'last_name'=>'Smolev',
            'pseudo' => 'Caretaker',
            'city' => 'Saint-Nazaire',
            'adresse' => 'Republique',  
            'avatar' => 'admin.png', 
            'role' => 'admin',
            'password' => Hash::make('admin2024!'), 
            'email' => 'admin@gmail.com', 
            'email_verified_at' => now(), 
            'remember_token' => Str::random(10), 
        ]); 
            User::factory(2)->create(); 
    }
    
}
