<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Usuario
 * 
 * @property int $idusuario
 * @property string $nm_usuario
 * @property string $cd_senha
 * @property string $ds_email
 * @property string $ds_celular
 * @property string|null $cd_cpf
 * @property string|null $cd_cnpj
 * @property mediumblob|null $imagem_user
 * 
 * @property Collection|Colecao[] $colecaos
 * @property Collection|MuraisVinculado[] $murais_vinculados
 * @property Collection|Mural[] $murals
 * @property Collection|Post[] $posts
 *
 * @package App\Models
 */
class Usuario extends Model
{
	protected $table = 'usuario';
	protected $primaryKey = 'idusuario';
	public $timestamps = false;

	// protected $casts = [
	// 	'imagem_user' => 'mediumblob'
	// ];

	protected $fillable = [
		'nm_usuario',
		'cd_senha',
		'ds_email',
		'ds_celular',
		'cd_cpf',
		'cd_cnpj',
		'imagem_user'
	];

	public function colecaos()
	{
		return $this->hasMany(Colecao::class, 'idusuario');
	}

	public function murais_vinculados()
	{
		return $this->hasMany(MuraisVinculado::class, 'idusuario');
	}

	public function murals()
	{
		return $this->hasMany(Mural::class, 'idusuario');
	}

	public function posts()
	{
		return $this->hasMany(Post::class, 'idusuario');
	}
}
