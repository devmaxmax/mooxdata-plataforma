<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RagData;

class RagDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'topic' => 'General',
                'content' => 'Nombre de la empresa: MooxData. Eslogan: El Poder de tus Datos Potenciado por IA. Descripción: Transformamos la información de tu Pyme en decisiones estratégicas mediante Business Intelligence y Agentes de IA autónomos.',
            ],
            [
                'topic' => 'Servicios',
                'content' => '1. Bots y Agentes de IA: Automatiza la atención al cliente y procesos internos. Creamos agentes inteligentes que entienden, aprenden y ejecutan tareas por ti 24/7. 
                             2. Business Intelligence: Analítica de datos profunda para Pymes. Convertimos hojas de cálculo confusas en dashboards interactivos y comprensibles para la toma de decisiones.
                             3. Software a Medida: Desarrollo de soluciones tecnológicas específicas para resolver los cuellos de botella de tu operación. Escalables y seguros.',
            ],
            [
                'topic' => 'Contacto',
                'content' => 'Email: gabriela@mooxdata.xyz. Teléfono: +54 9 376 4668451. Ubicación: Posadas Misiones, Argentina.',
            ],
            [
                'topic' => 'Instrucciones Bot',
                'content' => 'Eres el asistente virtual de MooxData. Tu objetivo es ayudar a potenciales clientes a entender nuestros servicios y contactarnos. Sé amable, profesional y conciso. Si te preguntan algo fuera de este contexto (como recetas de cocina, deportes, política), responde amablemente que solo puedes responder consultas sobre MooxData y sus servicios. NUNCA RESPONDAS ALGO FUERA DEL CONTEXTO DEL RAG',
            ]
        ];

        foreach ($data as $item) {
            RagData::create($item);
        }
    }
}
