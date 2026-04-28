<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Medicine;
use App\Models\Doctor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@medicare.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create Regular User
        User::create([
            'name' => 'John Doe',
            'email' => 'user@medicare.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // Create Categories
        $categories = [
            ['name' => 'Tablets', 'description' => 'Various medicinal tablets'],
            ['name' => 'Syrups', 'description' => 'Liquid medicines'],
            ['name' => 'Baby Care', 'description' => 'Products for infants'],
            ['name' => 'Personal Care', 'description' => 'Hygiene and skin care'],
            ['name' => 'Wellness', 'description' => 'Vitamins and supplements'],
            ['name' => 'Equipment', 'description' => 'Medical devices'],
        ];

        foreach ($categories as $cat) {
            $category = Category::create([
                'name' => $cat['name'],
                'slug' => Str::slug($cat['name']),
                'description' => $cat['description'],
            ]);

            // Create some medicines for each category
            for ($i = 1; $i <= 3; $i++) {
                Medicine::create([
                    'category_id' => $category->id,
                    'name' => $category->name . ' ' . $i,
                    'slug' => Str::slug($category->name . ' ' . $i),
                    'description' => 'This is a sample description for ' . $category->name . ' ' . $i,
                    'price' => rand(10, 100) + 0.99,
                    'stock' => rand(10, 100),
                    'type' => $category->name == 'Syrups' ? 'Syrup' : 'Tablet',
                    'status' => true,
                ]);
            }
        }

        // Create Doctors
        $doctors = [
            ['name' => 'Dr. Sarah Wilson', 'spec' => 'Cardiologist', 'exp' => '12 Years'],
            ['name' => 'Dr. Michael Chen', 'spec' => 'Pediatrician', 'exp' => '8 Years'],
            ['name' => 'Dr. Emma Davis', 'spec' => 'Dermatologist', 'exp' => '15 Years'],
        ];

        foreach ($doctors as $doc) {
            Doctor::create([
                'name' => $doc['name'],
                'specialization' => $doc['spec'],
                'experience' => $doc['exp'],
                'status' => true,
            ]);
        }
    }
}
