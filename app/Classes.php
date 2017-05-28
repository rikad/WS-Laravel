<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $table = 'class';

	protected $fillable = ['name','description','price'];

	public function room()
	{
		return $this->hasMany('App\Room');
	}

	public static function getValidation($id=null) {

		$validation = [
				'name' => 'required|unique:class',
				'description' => 'nullable',
				'price' => 'integer'
				];

		if ($id != null) {
			$validation['name'] = $validation['name'].',name,'.$id;
		}
		return  $validation;
	}

	public $timestamps = false;
}
