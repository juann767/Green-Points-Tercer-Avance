<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Roles
        DB::table('roles')->insert([
            ['nombre' => 'admin',   'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'usuario', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Usuarios de prueba
        DB::table('users')->insert([
            [
                'role_id'    => 1,
                'nombre'     => 'Administrador',
                'email'      => 'admin@greenpoints.com',
                'password'   => Hash::make('password'),
                'puntos'     => 0,
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'role_id'    => 2,
                'nombre'     => 'Diego López',
                'email'      => 'diego@mail.com',
                'password'   => Hash::make('password'),
                'puntos'     => 307,
                'created_at' => now(), 'updated_at' => now(),
            ],
        ]);

        // Acciones ecológicas
        DB::table('acciones_ecologicas')->insert([
            ['nombre' => 'Reciclaje de papel y cartón', 'descripcion' => 'Depositar papel o cartón en el contenedor correspondiente.', 'puntos_otorgados' => 30, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Reciclaje de vidrio',         'descripcion' => 'Depositar botellas y envases de vidrio.', 'puntos_otorgados' => 40, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Reciclaje de metal',          'descripcion' => 'Depositar latas y objetos metálicos.', 'puntos_otorgados' => 50, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Reciclaje de plástico',       'descripcion' => 'Depositar envases y bolsas plásticas.', 'puntos_otorgados' => 25, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Dispositivos
        DB::table('dispositivos')->insert([
            ['nombre' => 'Punto Verde — UES Central',     'ubicacion' => 'Blvd. Los Héroes, San Salvador',   'descripcion' => 'Acepta papel, vidrio, plástico.', 'estado' => 'activo',       'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'EcoBox — Mall Metrocentro',     'ubicacion' => 'Blvd. de los Próceres, SS',         'descripcion' => 'Acepta plástico, aluminio.',      'estado' => 'activo',       'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'EcoStation — Alcaldía SS',      'ubicacion' => 'Centro histórico, SS',              'descripcion' => 'Acepta todo tipo de material.',   'estado' => 'mantenimiento','created_at' => now(), 'updated_at' => now()],
        ]);

        // Premios
        DB::table('premios')->insert([
            ['nombre' => 'Kit de siembra',      'descripcion' => 'Kit completo para cultivar plantas en casa.',      'puntos_requeridos' => 200, 'stock' => 10, 'activo' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Bolsa ecológica',     'descripcion' => 'Bolsa reutilizable de tela resistente.',           'puntos_requeridos' => 150, 'stock' => 20, 'activo' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Botella reutilizable','descripcion' => 'Botella de acero inoxidable 500ml.',               'puntos_requeridos' => 350, 'stock' => 8,  'activo' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Libro ambiental',     'descripcion' => 'Libro sobre sostenibilidad y medio ambiente.',     'puntos_requeridos' => 160, 'stock' => 15, 'activo' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Certificado eco',     'descripcion' => 'Certificado digital de participación ecológica.',  'puntos_requeridos' => 100, 'stock' => 99, 'activo' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
