<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 * 
 * @property int $idpost
 * @property string|null $cd_link
 * @property mediumblob $imagem
 * @property string $ds_post
 * @property string $nm_post
 * @property Carbon $dt_validade
 * @property Carbon|null $dt_update
 * @property Carbon $dt_create
 * @property int|null $ic_favorito
 * @property int|null $ic_visualizado
 * @property int|null $idusuario
 * 
 * @property Usuario|null $usuario
 * @property Collection|Mural[] $murals
 * @property Collection|Colecao[] $colecaos
 *
 * @package App\Models
 */
class Post extends Model
{
	protected $table = 'post';
	protected $primaryKey = 'idpost';
	public $timestamps = false;

	protected $casts = [
		// 'imagem' => 'mediumblob',
		// 'ic_favorito' => 'int',
		// 'ic_visualizado' => 'int',
		// 'idusuario' => 'int'
	];

	protected $dates = [
		'dt_validade',
		'dt_update',
		'dt_create'
	];

	protected $fillable = [
		'cd_link',
		'imagem',
		'ds_post',
		'nm_post',
		'dt_validade',
		'dt_update',
		'dt_create',
		'ic_favorito',
		'ic_visualizado',
		'idusuario'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'idusuario');
	}

	public function murals()
	{
		return $this->belongsToMany(Mural::class, 'mural_post', 'idpost', 'idmural')
					->withPivot('idmural_post');
	}

	public function colecaos()
	{
		return $this->belongsToMany(Colecao::class, 'post_colecao', 'idpost', 'idcolecao')
					->withPivot('idpost_colecao');
	}
}
