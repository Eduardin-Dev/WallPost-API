<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MuraisVinculado
 * 
 * @property int $idvinculos
 * @property int|null $idusuario
 * @property int|null $idmural
 * 
 * @property Mural|null $mural
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class MuraisVinculado extends Model
{
	protected $table = 'murais_vinculados';
	protected $primaryKey = 'idvinculos';
	public $timestamps = false;

	protected $casts = [
		'idusuario' => 'int',
		'idmural' => 'int'
	];

	protected $fillable = [
		'idusuario',
		'idmural'
	];

	public function mural()
	{
		return $this->belongsTo(Mural::class, 'idmural');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'idusuario');
	}
}
