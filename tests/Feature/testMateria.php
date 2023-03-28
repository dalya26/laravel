<?php

namespace Tests\Feature;
use App\Http\Controllers\materiaController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\m_materia;
use Tests\TestCase;

class testMateria extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

     public function testListaMaterias()
     {
         /**
          * Realiza una solicitud GET a la ruta /api/materia y 
          * almacena la respuesta en la variable $response
          */
         $response = $this->get('/api/materias');
 
         /**
          * Verifica que la respuesta de la solicitud tenga un código de estado HTTP 200 (OK)
         * Si la respuesta no tiene este código, el test falla
         */
         $response->assertStatus(200);
 
         $response->assertJsonStructure([
             '*' => [
                 'id',
                 'nombre',
                 'profesor',
                 'horario',
                 'created_at',
                 'updated_at',
             ]
         ]);
     }
     public function testObtenerMateriaPorId()
     {
         // Suponiendo que existe un materia con ID 1 en la base de datos
         $id = 1;
 
         $response = $this->get('/api/materia?id=' . $id);
 
         $response->assertStatus(200);
         $response->assertJsonStructure([
            'id',
            'nombre',
            'profesor',
            'horario',
            'created_at',
            'updated_at',
         ]);
     }

     public function testGuardarMateria()
     {
         // Datos del materia
         $materia = [
            'id'=> 0,
            'nombre' => 'Test 1',
            'profesor' => 'Profesor 1',
            'horario'=> '123',
         ];
 
         // Envía una petición POST con los datos del materia
         $response = $this->post('/api/materia', $materia);
 
         // Verifica que se haya guardado el materia en la base de datos
         $this->assertDatabaseHas('materia', $materia);
         
         $response->assertStatus(201);
 
     }
     public function testBorrarMateria()
     {
         // Obtener el materia con ID 2
         $materia = m_materia::find(5);
 
         // Hacer una solicitud POST a la ruta de eliminación con el ID del materia
         $response = $this->json('POST', 'api/materia/borrar', ['id' => $materia->id]);
 
         // Verificar que la respuesta es 200 OK
         $response->assertStatus(200);
 
         // Verificar que el materia ha sido eliminado de la base de datos
         $this->assertDatabaseMissing('materia', ['id' => $materia->id]);
     }



    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
