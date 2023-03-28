<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\m_profesor;
use Tests\TestCase;

class testProfesor extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // Verificar respuesta de solicitud GET a la ruta /api/profesor
    public function testListaProfesores()
    {
        /**
         * Realiza una solicitud GET a la ruta /api/profesor y 
         * almacena la respuesta en la variable $response
         */
        $response = $this->get('/api/profesores');

        /**
         * Verifica que la respuesta de la solicitud tenga un código de estado HTTP 200 (OK)
        * Si la respuesta no tiene este código, el test falla
        */
        $response->assertStatus(200);

        $response->assertJsonStructure([
            '*' => [
                'id',
                'nombre',
                'matricula',
                'sexo',
                'edad',
                'cedula',
                'asignatura',
                'habilidades',
                'created_at',
                'updated_at',
                'id_materia',
            ]
        ]);
    }

    public function testObtenerProfesorPorId()
    {
        // Suponiendo que existe un alumno con ID 1 en la base de datos
        $id = 1;

        $response = $this->get('/api/profesor?id=' . $id);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'nombre',
            'matricula',
            'sexo',
            'edad',
            'cedula',
            'asignatura',
            'habilidades',
            'created_at',
            'updated_at',
        ]);
    }
    public function testGuardarPdofesor()
    {
        // Datos del profesor
        $profesor = [
            'id'=>0,
            'nombre'=>'Test 1',
            'matricula'=>'General',
            'sexo'=>'General',
            'edad'=>'General',
            'cedula'=>'General',
            'asignatura'=>'General',
            'habilidades'=>'General',
            'id_materia' => 1,

        ];

        // Envía una petición POST con los datos del profesor
        $response = $this->post('/api/profesor', $profesor);

        // Verifica que se haya guardado el profesor en la base de datos
        $this->assertDatabaseHas('profesor', $profesor);
        
        $response->assertStatus(201);

    }
    public function testBorrarProfesor()
    {
        // Obtener el alumno con ID 2
        $profesor = m_profesor::find(5);

        // Hacer una solicitud POST a la ruta de eliminación con el ID del profesor
        $response = $this->json('POST', 'api/profesor/borrar', ['id' => $profesor->id]);

        // Verificar que la respuesta es 200 OK
        $response->assertStatus(200);

        // Verificar que el profesor ha sido eliminado de la base de datos
        $this->assertDatabaseMissing('profesor', ['id' => $profesor->id]);
    }

    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
