<?php

namespace App\Controllers\API;

use App\Models\RolModel;
use CodeIgniter\RESTful\ResourceController;

class RolController extends ResourceController
{
	public function __construct()
	{
		$this->model = $this->setModel(new RolModel());			
	}

	public function index()
	{
		$rol = $this->model->findAll();
		return $this->respond($rol);
	}

	public function show($id = null)
  {
    try {
      //code...
      if ($id = $this->model->find($id)) {
        return $this->respond(
          [
            'msg' => 'El rol se encontro correctamente',
            'rol' => $id
          ],
          200
        );
      } else {
        return $this->respond(
          ['error' => 'No se puede encontrar el rol'],
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
			$rol = $this->request->getJSON(true);
      // $rol['password'] = password_hash($rol['password'], PASSWORD_DEFAULT);
			
			if($this->model->insert($rol)):
				return $this->respondCreated([
          'status' => 'created',
          'message' => 'Usuario creado',
          'data' => $rol,
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
    $rol = $this->request->getJSON(true);
    // $rol['password'] = password_hash($rol['password'], PASSWORD_DEFAULT);

    try {
      //code...
      if ($id = $this->model->find($id)) {
        $this->model->update($id, $rol);
        return $this->respond(
          [
            'msg' => 'El rol se actualizo correctamente',
            'rol' => $rol
          ],
          200
        );
      } else {
        return $this->respond(
          ['error' => 'No se puede encontrar el rol'],
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
          ['error' => 'No se puede eliminar el usuario'],
          500
        );
      } else {
        $rol = $this->model->find($id);
        if ($rol) {
          if ($this->model->delete($id)) {
            return $this->respond(
              [
                'msg' => 'El rol se elimino correctamente',
                'rol' => $rol
              ],
              200
            );
          } else {
            return $this->respond(
              ['error' => 'No se puede eliminar el rol'],
              500
            );
          }
        } else {
          return $this->respond(
            ['error' => 'El rol no existe!!'],
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
