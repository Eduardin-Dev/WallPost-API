<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MuralPost
 * 
 * @property int $idmural_post
 * @property int|null $idmural
 * @property int|null $idpost
 * 
 * @property Mural|null $mural
 * @property Post|null $post
 *
 * @package App\Models
 */
class MuralPost extends Model
{
	protected $table = 'mural_post';
	protected $primaryKey = 'idmural_post';
	public $timestamps = false;

	protected $casts = [
		'idmural' => 'int',
		'idpost' => 'int'
	];

	protected $fillable = [
		'idmural',
		'idpost'
	];

	public function mural()
	{
		return $this->belongsTo(Mural::class, 'idmural');
	}

	public function post()
	{
		return $this->belongsTo(Post::class, 'idpost');
	}
}
