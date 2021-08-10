<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PostColecao
 * 
 * @property int $idpost_colecao
 * @property int|null $idpost
 * @property int|null $idcolecao
 * 
 * @property Colecao|null $colecao
 * @property Post|null $post
 *
 * @package App\Models
 */
class PostColecao extends Model
{
	protected $table = 'post_colecao';
	protected $primaryKey = 'idpost_colecao';
	public $timestamps = false;

	protected $casts = [
		'idpost' => 'int',
		'idcolecao' => 'int'
	];

	protected $fillable = [
		'idpost',
		'idcolecao'
	];

	public function colecao()
	{
		return $this->belongsTo(Colecao::class, 'idcolecao');
	}

	public function post()
	{
		return $this->belongsTo(Post::class, 'idpost');
	}
}
