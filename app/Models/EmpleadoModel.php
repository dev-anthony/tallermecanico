<?php namespace App\Models;

use CodeIgniter\Model;

class EmpleadoModel extends Model
{
    protected $table      =       'empleado';
    protected $primaryKey =       'id_empleado';


    protected $returnType     =   'array';
    protected $allowedFields  =   ['nombre_empleado', 'apellido_paterno', 'apellido_materno', 'id_rol'];

    // protected $useTimestamps  =   false;
    // protected $createdFiled   =   'created_at'; 
    // protected $updateddFiled  =   'updated_at';
    
    // Reglas de validacion
    protected $validationRules = [
      'nombre_empleado' => 'required|min_length[3]|max_length[255]'
    ];

    // Mensajes personalizados
    protected $validationMessage = [
      'nombre_empleado' => [
        'min_length' => 'Minimo 3 caracteres',
        'max_length' => 'Minimo 255 caracteres',
      ]
    ];

    // No se puede saltar las validaciones predefinias en el modelo
    protected $skipValidation = false;
}