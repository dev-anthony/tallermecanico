<?php

namespace App\Controllers\API;

use App\Models\VehiculoModel;
use CodeIgniter\RESTful\ResourceController;

class VehiculoController extends ResourceController
{
	public function __construct()
	{
		$this->model = $this->setModel(new VehiculoModel());			
	}

	public function index()
	{
		$vehiculo = $this->model->findAll();
		return $this->respond($vehiculo);
	}

	public function show($id = null)
  {
    try {
      //code...
      if ($id = $this->model->find($id)) {
        return $this->respond(
          [
            'msg' => 'El vehiculo se encontro correctamente',
            'rol' => $id
          ],
          200
        );
      } else {
        return $this->respond(
          ['error' => 'No se puede encontrar el vehiculo'],
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
			$vehiculo = $this->request->getJSON(true);
			
			if($this->model->insert($vehiculo)):
				return $this->respondCreated([
          'status' => 'created',
          'message' => 'vehiculo creado',
          'data' => $vehiculo,
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
    $vehiculo = $this->request->getJSON(true);

    try {
      //code...
      if ($id = $this->model->find($id)) {
        $this->model->update($id, $vehiculo);
        return $this->respond(
          [
            'msg' => 'El vehiculo se actualizo correctamente',
            'rol' => $vehiculo
          ],
          200
        );
      } else {
        return $this->respond(
          ['error' => 'No se puede encontrar el vehiculo'],
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
          ['error' => 'No se puede eliminar el vehiculo'],
          500
        );
      } else {
        $vehiculo = $this->model->find($id);
        if ($vehiculo) {
          if ($this->model->delete($id)) {
            return $this->respond(
              [
                'msg' => 'El vehiculo se elimino correctamente',
                'rol' => $vehiculo
              ],
              200
            );
          } else {
            return $this->respond(
              ['error' => 'No se puede eliminar el vehiculo'],
              500
            );
          }
        } else {
          return $this->respond(
            ['error' => 'El vehiculo no existe!!'],
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
