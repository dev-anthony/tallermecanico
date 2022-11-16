<?php namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table      =       'usuario';
    protected $primaryKey =       'id_usuario';


    protected $returnType     =   'array';
    protected $allowedFields  =   ['nombre_usuario', 'apellido_paterno', 'apellido_materno', 'password', 'id_rol'];

    // protected $useTimestamps  =   false;
    // protected $createdFiled   =   'created_at'; 
    // protected $updateddFiled  =   'updated_at';
    
    // Reglas de validacion
    protected $validationRules = [
      'nombre_usuario' => 'required|min_length[3]|max_length[255]'
    ];

    // Mensajes personalizados
    protected $validationMessage = [
      'nombre_usuario' => [
        'min_length' => 'Minimo 3 caracteres',
        'max_length' => 'Minimo 255 caracteres',
      ]
    ];

    // No se puede saltar las validaciones predefinias en el modelo
    protected $skipValidation = false;
}