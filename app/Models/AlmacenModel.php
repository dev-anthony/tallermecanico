<?php namespace App\Models;

use CodeIgniter\Model;

class AlmacenModel extends Model
{
    protected $table      =       'almacen';
    protected $primaryKey =       'id_almacen';


    protected $returnType     =   'array';
    protected $allowedFields  =   ['nombre_refaccion', 'cantidad_refaccion', 'precio_unitario', 'precio_venta', 'id_rol'];

    // protected $useTimestamps  =   false;
    // protected $createdFiled   =   'created_at'; 
    // protected $updateddFiled  =   'updated_at';
    
    // Reglas de validacion
    protected $validationRules = [
      'nombre_refaccion' => 'required|min_length[3]|max_length[255]'
    ];

    // Mensajes personalizados
    protected $validationMessage = [
      'nombre_refaccion' => [
        'min_length' => 'Minimo 3 caracteres',
        'max_length' => 'Minimo 255 caracteres',
      ]
    ];

    // No se puede saltar las validaciones predefinias en el modelo
    protected $skipValidation = false;
}