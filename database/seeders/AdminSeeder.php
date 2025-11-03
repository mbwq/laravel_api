<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Inscription;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Exemple : supprimer un admin spécifique avant d'en recréer un
        $admin = Inscription::where('email', 'jeann.hanne@gmail.com')
            ->where('role', 'admin')
            ->first();

        if ($admin) {
            $admin->delete();
            echo "✅ Admin supprimé avec succès\n";
        } else {
            echo "⚠️ Aucun admin trouvé à supprimer\n";
        }

        // Optionnel : recréer un admin juste après
        $newAdmin = Inscription::create([
            'name' => 'HANNE',
            'firstname' => 'jeann',
            'email' => 'jeann.hanne12@gmail.com',
            'password' => bcrypt('admin1234'),
            'role' => 'admin',
        ]);

        echo "✅ Nouvel admin créé : {$newAdmin->email}\n";;
    }
}
