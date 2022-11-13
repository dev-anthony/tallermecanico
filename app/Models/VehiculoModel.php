<?php namespace App\Models;

use CodeIgniter\Model;

class VehiculoModel extends Model
{
    protected $table      =       'vehiculo';
    protected $primaryKey =       'id_vehiculo';


    protected $returnType     =   'array';
    protected $allowedFields  =   ['nombre_propietario', 'apellido_paterno', 'apellido_materno', 'marca_vehiculo', 'modelo_vehiculo', 'matricula_vehiculo', 'matricula_vehiculo', 'tipo_servicio'];

    // protected $useTimestamps  =   false;
    // protected $createdFiled   =   'created_at'; 
    // protected $updateddFiled  =   'updated_at';
    
    // Reglas de validacion
    protected $validationRules = [
      'nombre_propietario' => 'required|min_length[4]|max_length[30]'
    ];

    // Mensajes personalizados
    protected $validationMessage = [
      'nombre_propietario' => [
        'min_length' => 'Minimo 4 letras'
      ]
    ];

    // No se puede saltar las validaciones predefinias en el modelo
    protected $skipValidation = false;
}