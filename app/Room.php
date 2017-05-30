<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = ['code','description','class_id'];

    public function class()
    {
        return $this->belongsTo('App\Classes');
    }

	public static function getValidation($id=null) {

		$validation = [
				'code' => 'required|unique:rooms',
				'description' => 'nullable',
				'class_id' => 'required|exists:class,id'
				];

		if ($id != null) {
			$validation['code'] = $validation['code'].',code,'.$id;
		}
		return  $validation;
	}

    public $timestamps = false;
}
