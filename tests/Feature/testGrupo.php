<?php

namespace Tests\Feature;
use App\Http\Controllers\grupoController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\m_grupo;
use Tests\TestCase;

class testGrupo extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

 // Verificar respuesta de solicitud GET a la ruta /api/alumnos
    public function testListaGrupos()
    {
        /**
         * Realiza una solicitud GET a la ruta /api/alumnos y 
         * almacena la respuesta en la variable $response
         */
        $response = $this->get('/api/grupos');

        /**
         * Verifica que la respuesta de la solicitud tenga un código de estado HTTP 200 (OK)
        * Si la respuesta no tiene este código, el test falla
        */
        $response->assertStatus(200);

        $response->assertJsonStructure([
            '*' => [
                'id',
                'grupo',
            ]
        ]);
    }

    public function testObtenerGrupoPorId()
    {
        // Suponiendo que existe un grupo con ID 1 en la base de datos
        $id = 1;

        $response = $this->get('/api/grupo?id=' . $id);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'grupo',
            'created_at',
            'updated_at',
        ]);
    }
    public function testGuardarGrupo()
    {
        // Datos del grupo
        $grupo = [
            'id' => 0,
            'grupo' => 'Test 1',
        ];

        // Envía una petición POST con los datos del grupo
        $response = $this->post('/api/grupo', $grupo);

        // Verifica que se haya guardado el alumno en la base de datos
        $this->assertDatabaseHas('grupos', $grupo);
        
        $response->assertStatus(201);

    }

    public function testBorrarGrupo()
    {
        // Obtener el grupo con ID 2
        $grupo = m_grupo::find(5);

        // Hacer una solicitud POST a la ruta de eliminación con el ID del grupo
        $response = $this->json('POST', 'api/grupo/borrar', ['id' => $grupo->id]);

        // Verificar que la respuesta es 200 OK
        $response->assertStatus(200);

        // Verificar que el grupo ha sido eliminado de la base de datos
        $this->assertDatabaseMissing('grupos', ['id' => $grupo->id]);
    }

    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
<<<<<<< HEAD
=======
        
>>>>>>> 6d2c4d7db7e5b864b053fa0cef95826fa668ecc2
    }
}
