<?php namespace App\Models;

use CodeIgniter\Model;

class RolModel extends Model
{
    protected $table      =       'rol';
    protected $primaryKey =       'id_rol';


    protected $returnType     =   'array';
    protected $allowedFields  =   ['tipo_rol'];

    // protected $useTimestamps  =   false;
    // protected $createdFiled   =   'created_at'; 
    // protected $updateddFiled  =   'updated_at';
    
    // Reglas de validacion
    protected $validationRules = [
      'tipo_rol' => 'required|min_length[4]|max_length[30]|is_unique[rol.tipo_rol]'
    ];

    // Mensajes personalizados
    protected $validationMessage = [
      'tipo_rol' => [
        'required' => 'El campo {field} es requerido',
        'min_length' => 'Minimo 4 caracteres',
        'max_length' => 'Maximo 30 caracteres',
        'is_unique' => 'El {field} ya existe',
      ]
    ];

    // No se puede saltar las validaciones predefinias en el modelo
    protected $skipValidation = false;
}