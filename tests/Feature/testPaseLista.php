<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\m_pase_lista;


class testPaseLista extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testPaseLista()
    {
        /**
         * Realiza una solicitud GET a la ruta /api/paselista y 
         * almacena la respuesta en la variable $response
         */
        $response = $this->get('/api/paselista');

        /**
         * Verifica que la respuesta de la solicitud tenga un código de estado HTTP 200 (OK)
        * Si la respuesta no tiene este código, el test falla
        */
        $response->assertStatus(200);

        $response->assertJsonStructure([
            '*' => [
                'id',
                'asistio',
                'fecha',
                'created_at',
                'updated_at',
            ]
        ]);
    }
    public function testGuardarPaseLista()
    {
        // Datos del paselista
        $paselista = [
            'id' => 0,
            'asistio' => '0',
            'fecha' => '27/03/23',
            'id_materia' => 1,
        ];

        // Envía una petición POST con los datos del paselista
        $response = $this->post('/api/alumno', $paselista);

        // Verifica que se haya guardado el paselista en la base de datos
        $this->assertDatabaseHas('pase_lista', $paselista);
        
        $response->assertStatus(201);

    }


    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
