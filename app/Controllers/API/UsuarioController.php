<?php

namespace App\Controllers\API;

use App\Models\UsuarioModel;
use CodeIgniter\RESTful\ResourceController;

class UsuarioController extends ResourceController
{
	public function __construct()
	{
		$this->model = $this->setModel(new UsuarioModel());			
	}

	public function index()
	{
		$usuario = $this->model->findAll();
		return $this->respond($usuario);
	}

	public function show($id = null)
  {
    try {
      //code...
      if ($id = $this->model->find($id)) {
        return $this->respond(
          [
            'msg' => 'El usuario se encontro correctamente',
            'rol' => $id
          ],
          200
        );
      } else {
        return $this->respond(
          ['error' => 'No se puede encontrar el usuario'],
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
      // Lo que hace es guardar los datos validados y haseha el password
      $usuario = $this->request->getJSON(true);
      $usuario['password'] = password_hash($usuario['password'], PASSWORD_DEFAULT);

      if ($this->model->insert($usuario) == false) {
        return $this->fail($this->model->validation->listErrors());
      } else {

        $this->model->insert($usuario);
        return $this->respondCreated([
          'status' => 'created',
          'message' => 'Usuario creado',
          'data' => $usuario,
        ], 201);
      }
    } catch (\Exception $e) {
      return $this->failServerError('Error en el servidor', $e->getMessage());
    }
  }

	public function edit($id = null)
  {
    $usuario = $this->request->getJSON(true);
    $usuario['password'] = password_hash($usuario['password'], PASSWORD_DEFAULT);

    try {
      //code...
      if ($id = $this->model->find($id)) {
        $this->model->update($id, $usuario);
        return $this->respond(
          [
            'msg' => 'El usuario se actualizo correctamente',
            'rol' => $usuario
          ],
          200
        );
      } else {
        return $this->respond(
          ['error' => 'No se puede encontrar el usuario'],
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
        $usuario = $this->model->find($id);
        if ($usuario) {
          if ($this->model->delete($id)) {
            return $this->respond(
              [
                'msg' => 'El usuario se elimino correctamente',
                'rol' => $usuario
              ],
              200
            );
          } else {
            return $this->respond(
              ['error' => 'No se puede eliminar el usuario'],
              500
            );
          }
        } else {
          return $this->respond(
            ['error' => 'El usuario no existe!!'],
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
