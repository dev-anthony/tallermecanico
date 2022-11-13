<?php

namespace App\Controllers\API;

use App\Models\EmpleadoModel;
use CodeIgniter\RESTful\ResourceController;

class EmpleadoController extends ResourceController
{
	public function __construct()
	{
		$this->model = $this->setModel(new EmpleadoModel());			
	}

	public function index()
	{
		$empleado = $this->model->findAll();
		return $this->respond($empleado);
	}

	public function show($id = null)
  {
    try {
      //code...
      if ($id = $this->model->find($id)) {
        return $this->respond(
          [
            'msg' => 'El empleado se encontro correctamente',
            'rol' => $id
          ],
          200
        );
      } else {
        return $this->respond(
          ['error' => 'No se puede encontrar el empleado'],
          500
        );
      }
    } catch (\Exception $e) {
      //Exception $e;
      return $this->failServerError('Error en el servidor', $e->getMessage());
    }
  }

	public function create()
	{
		try {
			//code...
			$empleado = $this->request->getJSON(true);
			
			if($this->model->insert($empleado)):
				return $this->respondCreated([
          'status' => 'created',
          'message' => 'empleado creado',
          'data' => $empleado,
        ], 201);

			else:
				return $this->failValidationErrors($this->model->validation->listErrors());
			endif;

		} catch (\Exception $e) {
			//Exception $e;
			return $this->failServerError('Ocurrio algo con el servidor!!', $e);
		}
	}

	public function edit($id = null)
  {
    $empleado = $this->request->getJSON(true);

    try {
      //code...
      if ($id = $this->model->find($id)) {
        $this->model->update($id, $empleado);
        return $this->respond(
          [
            'msg' => 'El empleado se actualizo correctamente',
            'rol' => $empleado
          ],
          200
        );
      } else {
        return $this->respond(
          ['error' => 'No se puede encontrar el empleado'],
          500
        );
      }
    } catch (\Exception $e) {
      return $this->failServerError('Error en el servidor', $e->getMessage());
    }
	}

		public function delete($id = null)
  {
    try {
      //code...
      if ($id == null) {
        return $this->respond(
          ['error' => 'No se puede eliminar el empleado'],
          500
        );
      } else {
        $empleado = $this->model->find($id);
        if ($empleado) {
          if ($this->model->delete($id)) {
            return $this->respond(
              [
                'msg' => 'El empleado se elimino correctamente',
                'rol' => $empleado
              ],
              200
            );
          } else {
            return $this->respond(
              ['error' => 'No se puede eliminar el empleado'],
              500
            );
          }
        } else {
          return $this->respond(
            ['error' => 'El empleado no existe!!'],
            500
          );
        }
      }
    } catch (\Exception $e) {
      //Exception $e;
      return $this->failServerError('Error en el servidor', $e->getMessage());
    }
  }

}
