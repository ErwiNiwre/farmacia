<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CodigosSinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('codigos_sin')->insert([
            ['id' =>  '1', 'codigo' => '1001479', 'descripcion' => 'Ácido acetilsalicíLico-aspirina', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '2', 'codigo' => '1001483', 'descripcion' => 'Ácido glutámico y sus sales', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '3', 'codigo' => '1001481', 'descripcion' => 'Ácido saLicílico', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '4', 'codigo' => '1001509', 'descripcion' => 'Agua estéril para inyectables', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '5', 'codigo' => '1001519', 'descripcion' => 'Algodon esterilizado', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '6', 'codigo' => '1001529', 'descripcion' => 'Amalgamas para prótesis dental', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '7', 'codigo' => '1001485', 'descripcion' => 'Amidas acíclicas ', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '8', 'codigo' => '1001486', 'descripcion' => 'Amidas cíclicas', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '9', 'codigo' => '1001533', 'descripcion' => 'Antibióticos', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '10', 'codigo' => '1001518', 'descripcion' => 'Apósitos', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '11', 'codigo' => '1001492', 'descripcion' => 'Azúcares químicamente puros ', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '12', 'codigo' => '1001536', 'descripcion' => 'azúcares químicamente puros.', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '13', 'codigo' => '1001527', 'descripcion' => 'Botiquines de emergencia', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '14', 'codigo' => '1001528', 'descripcion' => 'Cemento para prótesis dental', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '15', 'codigo' => '1001534', 'descripcion' => 'cementos para la reconstrucción de huesos.', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '16', 'codigo' => '1001511', 'descripcion' => 'Coagulantes microbianos', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '17', 'codigo' => '1003227', 'descripcion' => 'Descongestionantesnasales.', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '18', 'codigo' => '1001510', 'descripcion' => 'Endulzantes sintéticos y edulcorantes', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '19', 'codigo' => '1003228', 'descripcion' => 'Expectorantes.', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '20', 'codigo' => '1001532', 'descripcion' => 'Gasa', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '21', 'codigo' => '1001488', 'descripcion' => 'Hidantoina y compuestos', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '22', 'codigo' => '1001538', 'descripcion' => 'hilo de sutura quirúrgica.', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '23', 'codigo' => '1001517', 'descripcion' => 'lnterferones', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '24', 'codigo' => '1001520', 'descripcion' => 'Jarabes medicinales', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '25', 'codigo' => '1001487', 'descripcion' => 'Lactonas y compuestos', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '26', 'codigo' => '1003225', 'descripcion' => 'Leche de fórmula.', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '27', 'codigo' => '1001484', 'descripcion' => 'Lecitina y otros animolípidos', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '28', 'codigo' => '1001482', 'descripcion' => 'Lisina y compuestos', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '29', 'codigo' => '1001522', 'descripcion' => 'Medicamentos anestésicos', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '30', 'codigo' => '1001530', 'descripcion' => 'Metales para prótesis dental', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '31', 'codigo' => '1003226', 'descripcion' => 'Pañales desechables y toallitas húmedas.', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '32', 'codigo' => '1001524', 'descripcion' => 'Parche transdérmico', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '33', 'codigo' => '1001531', 'descripcion' => 'Pomadas y ungüentos medicinales', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '34', 'codigo' => '1003655', 'descripcion' => 'Preparados farmacéuticos para uso médico como: ampollas, tabletas, cápsulas, ungüentos, polvos y soluciones.', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '35', 'codigo' => '1001539', 'descripcion' => 'Productos de biotecnología.', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '36', 'codigo' => '1001537', 'descripcion' => 'Productos endocrinos y extractos endocrinos.', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '37', 'codigo' => '1001500', 'descripcion' => 'Productos farmacéuticos antíalérgicos', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '38', 'codigo' => '1001513', 'descripcion' => 'Productos farmacéuticos anticonceptivos', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '39', 'codigo' => '1001499', 'descripcion' => 'Productos farmacéuticos antiespasmódicos', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '40', 'codigo' => '1001498', 'descripcion' => 'Productos farmacéuticos antigripales', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '41', 'codigo' => '1001495', 'descripcion' => 'Productos farmacéuticos antiinfecciosos', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '42', 'codigo' => '1001494', 'descripcion' => 'Productos farmacéuticos antiinflamatorios', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '43', 'codigo' => '1001507', 'descripcion' => 'Productos farmacéuticos antiparasitarios', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '44', 'codigo' => '1001508', 'descripcion' => 'Productos farmacéuticos antireumáticos', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '45', 'codigo' => '1001496', 'descripcion' => 'Productos farmacéuticos antisépticos', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '46', 'codigo' => '1001502', 'descripcion' => 'Productos farmacéuticos antitusivos', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '47', 'codigo' => '1001497', 'descripcion' => 'Productos farmacéuticos antivirales', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '48', 'codigo' => '1001503', 'descripcion' => 'Productos farmacéuticos dermatológicos', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '49', 'codigo' => '1001501', 'descripcion' => 'Productos farmacéuticos ginecológicos', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '50', 'codigo' => '1001493', 'descripcion' => 'Productos farmacéuticos homeopáticos', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '51', 'codigo' => '1001491', 'descripcion' => 'Productos farmacéuticos hormonales', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '52', 'codigo' => '1001504', 'descripcion' => 'Productos farmacéuticos metabolicos (digestívos)', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '53', 'codigo' => '1001505', 'descripcion' => 'Productos farmacéuticos para el sistema nerviosos', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '54', 'codigo' => '1001506', 'descripcion' => 'Productos farmacéuticos para los sentidos', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '55', 'codigo' => '1001512', 'descripcion' => 'Productos farmacéuticos, para uso veterinario', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '56', 'codigo' => '1003223', 'descripcion' => 'Productos para el cuidado de Piel', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '57', 'codigo' => '1003224', 'descripcion' => 'Productos para el cuidado Oral', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '58', 'codigo' => '1003230', 'descripcion' => 'Productos para la higiene íntima femenina (toallitas, geles, desodorantes íntimos).', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '59', 'codigo' => '1001490', 'descripcion' => 'Provitaminas y vitaminas', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '60', 'codigo' => '1001535', 'descripcion' => 'Pruebas de embarazo.', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '61', 'codigo' => '1001480', 'descripcion' => 'Salicilato de metilo', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '62', 'codigo' => '1003229', 'descripcion' => 'Sprays nasales y aerosoles para la tos.', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '63', 'codigo' => '1001514', 'descripcion' => 'Sueros y plasma', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '64', 'codigo' => '1001489', 'descripcion' => 'Sulfonamidas', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '65', 'codigo' => '1001526', 'descripcion' => 'Suturas quirúrgicas', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '66', 'codigo' => '1001516', 'descripcion' => 'Vacunas', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '67', 'codigo' => '1001525', 'descripcion' => 'Vendas adhesivas', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
            ['id' =>  '68', 'codigo' => '1001521', 'descripcion' => 'Veneno de serpientes', 'created_at' => '2025/08/11', 'updated_at' => '2025/08/11'],
        ]);

        // Adjust Table Sequence codigos_sin
        DB::statement("SELECT setval(pg_get_serial_sequence('codigos_sin', 'id'), coalesce(max(id), 0)+1, false) FROM codigos_sin");
    }
}
