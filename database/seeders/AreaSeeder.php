<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Area::create(['nome' => 'Agricultura']);
        Area::create(['nome' => 'Alimentação']);
        Area::create(['nome' => 'Comércio']);
        Area::create(['nome' => 'Comunicação']);
        Area::create(['nome' => 'Construção']);
        Area::create(['nome' => 'Educação']);
        Area::create(['nome' => 'Empregos']);
        Area::create(['nome' => 'Energia']);
        Area::create(['nome' => 'Eventos']);
        Area::create(['nome' => 'Governo']);
        Area::create(['nome' => 'Indústria']);
        Area::create(['nome' => 'Infraestrtutura de Software']);
        Area::create(['nome' => 'Imobiliário']);
        Area::create(['nome' => 'Lazer']);
        Area::create(['nome' => 'Logística']);
        Area::create(['nome' => 'Mobilidade Urbana']);
        Area::create(['nome' => 'Música']);
        Area::create(['nome' => 'Pecuária']);
        Area::create(['nome' => 'Pets']);
        Area::create(['nome' => 'Recursos Humanos']);
        Area::create(['nome' => 'Saúde']);
        Area::create(['nome' => 'Segurança']);
        Area::create(['nome' => 'Seguros']);
        Area::create(['nome' => 'Serviços em Geral']);
        Area::create(['nome' => 'Serviços Financeiros']);
        Area::create(['nome' => 'Sustentabilidade / Reciclagem']);
        Area::create(['nome' => 'Transporte']);
        Area::create(['nome' => 'Turismo']);
        Area::create(['nome' => 'Vestuário']);
        Area::create(['nome' => 'Varejo Supermercadista']);
        Area::create(['nome' => 'Veículos']);
    }
}
