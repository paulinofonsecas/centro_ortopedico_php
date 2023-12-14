<?php

namespace Database\Seeders;

use App\Models\Municipio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MunicipioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $municipios = [
            'Bengo' => ['Ambriz', 'Bula Atumba', 'Dande', 'Demba Chio', 'Nambuangongo', 'Pango Aluquém', 'Quibaxe', 'Quiculungo', 'Caxito'],
            'Benguela' => ['Baía Farta', 'Balombo', 'Benguela', 'Bocoio', 'Caimbambo', 'Catumbela', 'Chongorói', 'Cubal', 'Cubal do Lumbo', 'Ganda', 'Lobito'],
            'Bié' => ['Andulo', 'Camacupa', 'Catabola', 'Chinguar', 'Chitembo', 'Cuemba', 'Cunhinga', 'Kuito', 'Kunje', 'Nharea'],
            'Cabinda' => ['Belize', 'Buco-Zau', 'Cabinda', 'Cacongo', 'Landana'],
            'Cuando Cubango' => ['Calai', 'Cuangar', 'Cuchi', 'Cuito Cuanavale', 'Dirico', 'Longa', 'Mavinga', 'Menongue', 'Nancova', 'Rivungo'],
            'Cuanza Norte' => ['Ambaca', 'Banga', 'Bolongongo', 'Cambambe', 'Cazengo', 'Golungo Alto', 'Gonguembo', 'Lucala', 'Quiculungo', 'Samba Cajú', 'Ucuma'],
            'Cuanza Sul' => ['Amboim', 'Cassongue', 'Conda', 'Ebo', 'Libolo', 'Mussende', 'Porto Amboim', 'Quibala', 'Quilenda', 'Seles'],
            'Cunene' => ['Cahama', 'Cuanhama', 'Curoca', 'Cuvelai', 'Namacunde', 'Ombadja'],
            'Huambo' => ['Bailundo', 'Caála', 'Catchiungo', 'Chicala-Cholohanga', 'Chinjenje', 'Ekunha', 'Huambo', 'Londuimbale', 'Longonjo', 'Mungo', 'Tchicala-Tcholoanga', 'Ucuma'],
            'Huíla' => ['Caconda', 'Cacula', 'Caluquembe', 'Chibia', 'Chicomba', 'Chipindo', 'Gambos', 'Ganda', 'Humpata', 'Jamba', 'Lubango', 'Matala', 'Quilengues'],
            'Lunda Norte' => ['Cambulo', 'Capenda-Camulemba', 'Caungula', 'Chitato', 'Cuango', 'Cuilo', 'Lubalo', 'Lucapa', 'Xá-Muteba'],
            'Lunda Sul' => ['Cacolo', 'Dala', 'Muconda', 'Saurimo'],
            'Malanje' => ['Cacuso', 'Calandula', 'Cangandala', 'Cuaba Nzogo', 'Cunda-Dia-Baze', 'Kambundi-Katembo', 'Malanje', 'Marimba', 'Massango', 'Mucari', 'Quela'],
            'Moxico' => ['Alto Zambeze', 'Bundas', 'Camanongue', 'Cameia', 'Léua', 'Luacano'],
            'Namibe' => ['Bibala', 'Camucuio', 'Moçâmedes', 'Tômbwa', 'Virei'],
            'Uíge' => ['Alto Cauale', 'Ambuila', 'Bembe', 'Buengas', 'Bungo', 'Damba', 'Kimbele', 'Macocola', 'Mucaba', 'Negage', 'Puri', 'Quimbele', 'Quitexe', 'Sanza Pombo', 'Uíge'],
            'Zaire' => ['Cuimba', 'Mbanza Kongo', 'Nóqui', 'Soyo', 'Tomboco'],
        ];

        foreach ($municipios as $nome => $municipios) {
            Municipio::create(['nome' => $nome]);
            foreach ($municipios as $municipio) {
                Municipio::create(['nome' => $municipio]);
            }
        }
}
}
