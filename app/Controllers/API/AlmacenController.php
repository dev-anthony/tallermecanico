<?php

namespace App\Controllers\API;

use App\Models\AlmacenModel;
use CodeIgniter\RESTful\ResourceController;

class AlmacenController extends ResourceController
{
	public function __construct()
	{
		$this->model = $this->setModel(new AlmacenModel());			
	}

	public function index()
	{
		$almacen = $this->model->findAll();
		return $this->respond($almacen);
	}

	public function show($id = null)
  {
    try {
      //code...
      if ($id = $this->model->find($id)) {
        return $this->respond(
          [
            'msg' => 'El stock se encontro correctamente',
            'rol' => $id
          ],
          200
        );
      } else {
        return $this->respond(
          ['error' => 'No se puede encontrar el stock'],
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
			$almacen = $this->request->getJSON(true);
			
			if($this->model->insert($almacen)):
				return $this->respondCreated([
          'status' => 'created',
          'message' => 'stock creado',
          'data' => $almacen,
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
    $almacen = $this->request->getJSON(true);

    try {
      //code...
      if ($id = $this->model->find($id)) {
        $this->model->update($id, $almacen);
        return $this->respond(
          [
            'msg' => 'El stock se actualizo correctamente',
            'rol' => $almacen
          ],
          200
        );
      } else {
        return $this->respond(
          ['error' => 'No se puede encontrar el stock'],
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
          ['error' => 'No se puede eliminar el stock'],
          500
        );
      } else {
        $almacen = $this->model->find($id);
        if ($almacen) {
          if ($this->model->delete($id)) {
            return $this->respond(
              [
                'msg' => 'El stock se elimino correctamente',
                'rol' => $almacen
              ],
              200
            );
          } else {
            return $this->respond(
              ['error' => 'No se puede eliminar el stock'],
              500
            );
          }
        } else {
          return $this->respond(
            ['error' => 'El stock no existe!!'],
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
