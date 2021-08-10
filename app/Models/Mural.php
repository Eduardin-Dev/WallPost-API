<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Mural
 * 
 * @property int $idmural
 * @property string|null $ds_mural
 * @property int|null $ic_public
 * @property string|null $cd_chave
 * @property string|null $id_qrcode
 * @property string|null $nm_mural
 * @property Carbon|null $dt_create
 * @property Carbon|null $dt_update
 * @property int|null $idusuario
 * 
 * @property Usuario|null $usuario
 * @property Collection|MuraisVinculado[] $murais_vinculados
 * @property Collection|Post[] $posts
 *
 * @package App\Models
 */
class Mural extends Model
{
	protected $table = 'mural';
	protected $primaryKey = 'idmural';
	public $timestamps = false;

	protected $casts = [
		'ic_public' => 'int',
		'idusuario' => 'int'
	];

	protected $dates = [
		'dt_create',
		'dt_update'
	];

	protected $fillable = [
		'ds_mural',
		'ic_public',
		'cd_chave',
		'id_qrcode',
		'nm_mural',
		'dt_create',
		'dt_update',
		'idusuario'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'idusuario');
	}

	public function murais_vinculados()
	{
		return $this->hasMany(MuraisVinculado::class, 'idmural');
	}

	public function posts()
	{
		return $this->belongsToMany(Post::class, 'mural_post', 'idmural', 'idpost')
					->withPivot('idmural_post');
	}
}
