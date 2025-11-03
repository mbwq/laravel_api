<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Produit;

class ProduitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Produit::create([
            'nom' => 'Maillot Domicile PSG',
            'prix' => 59.99,
            'description' => 'Maillot au plus fidèle que porte les joueurs avec technologie Engineered aspire la transpiration.',
            'photo_principale' => 'PSG_Domicile.jpg',
            'category_id' => 1,
        ]);

        Produit::create([
            'nom' => 'Maillot Exterieur PSG',
            'prix' => 49.99,
            'description' => 'Maillot Exterieur au plus fidèle que porte les joueurs avec technologie Engineered aspire la transpiration.',
            'photo_principale' => 'PSG_Exterieur_2.jpg',
            'category_id' => 1,
        ]);

        Produit::create([
            'nom' => 'Maillot Third PSG',
            'prix' => 49.99,
            'description' => 'Maillot Third au plus fidèle que porte les joueurs avec technologie Engineered aspire la transpiration.',
            'photo_principale' => 'PSG_maillot_3.jpg',
            'category_id' => 1,
        ]);

        Produit::create([
            'nom' => 'PSG porte-clé Champion League',
            'prix' => 6.99,
            'description' => 'Porte clé tropher ligue des champion en argent.',
            'photo_principale' => 'porte_trophy.jpg',
            'category_id' => 2,
        ]);

        Produit::create([
            'nom' => 'PSG porte-clé logo',
            'prix' => 4.99,
            'description' => 'Porte clé logo en argent.',
            'photo_principale' => 'porte_cle.jpg',
            'category_id' => 2,
        ]);

        Produit::create([
            'nom' => 'PSG Echarpe bleu',
            'prix' => 14.99,
            'description' => 'Echarpe PSG en coton fait maison.',
            'photo_principale' => 'echarpe.jpg',
            'category_id' => 3,
        ]);
        
        Produit::create([
            'nom' => 'PSG Echarpe blanc',
            'prix' => 14.99,
            'description' => 'Echarpe PSG blanc en coton fait maison.',
            'photo_principale' => 'echarpe2.jpg',
            'category_id' => 3,
        ]);
    }
}
