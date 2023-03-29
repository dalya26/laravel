<?php

namespace Tests\Feature;
use App\Http\Controllers\alumnoController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\m_alumno;
use Tests\TestCase;

class testAlumno extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

 // Verificar respuesta de solicitud GET a la ruta /api/alumnos
    public function testListaAlumnos()
    {
        /**
         * Realiza una solicitud GET a la ruta /api/alumnos y 
         * almacena la respuesta en la variable $response
         */
        $response = $this->get('/api/alumnos');

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
                'created_at',
                'updated_at',
                'id_materia',
                'nombre_materia',
            ]
        ]);
    }

    public function testObtenerAlumnoPorId()
    {
        // Suponiendo que existe un alumno con ID 1 en la base de datos
        $id = 1;

        $response = $this->get('/api/alumno?id=' . $id);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'nombre',
            'matricula',
            'sexo',
            'edad',
            'created_at',
            'updated_at',
        ]);
    }
    public function testGuardarAlumno()
    {
        // Datos del alumno
        $alumno = [
            'id' => 0,
            'nombre' => 'Test 1',
            'matricula' => '123',
            'sexo' => 'M',
            'edad' => '19',
            'id_materia' => 1,
        ];

        // Envía una petición POST con los datos del alumno
        $response = $this->post('/api/alumno', $alumno);

        // Verifica que se haya guardado el alumno en la base de datos
        $this->assertDatabaseHas('alumnos', $alumno);
        
        $response->assertStatus(201);

    }

    public function testBorrarAlumno()
    {
        // Obtener el alumno con ID 2
        $alumno = m_alumno::find(5);

        // Hacer una solicitud POST a la ruta de eliminación con el ID del alumno
        $response = $this->json('POST', 'api/alumno/borrar', ['id' => $alumno->id]);

        // Verificar que la respuesta es 200 OK
        $response->assertStatus(200);

        // Verificar que el alumno ha sido eliminado de la base de datos
        $this->assertDatabaseMissing('alumnos', ['id' => $alumno->id]);
    }

    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
