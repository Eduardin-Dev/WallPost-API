<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Colecao
 * 
 * @property int $idcolecao
 * @property string|null $nm_colecao
 * @property int|null $idusuario
 * 
 * @property Usuario|null $usuario
 * @property Collection|Post[] $posts
 *
 * @package App\Models
 */
class Colecao extends Model
{
	protected $table = 'colecao';
	protected $primaryKey = 'idcolecao';
	public $timestamps = false;

	protected $casts = [
		'idusuario' => 'int'
	];

	protected $fillable = [
		'nm_colecao',
		'idusuario'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'idusuario');
	}

	public function posts()
	{
		return $this->belongsToMany(Post::class, 'post_colecao', 'idcolecao', 'idpost')
					->withPivot('idpost_colecao');
	}
}
