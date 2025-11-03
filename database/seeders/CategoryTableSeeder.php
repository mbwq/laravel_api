<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Categorie
        $category = new Category();
        $category->nom = "Maillot";
        $category->is_online = 1;
        $category->save();

        $category = new Category();
        $category->nom = "Porte Clé";
        $category->is_online = 1;
        $category->save();

        $category = new Category();
        $category->nom = "Echarpe";
        $category->is_online = 1;
        $category->save();
    }
}
