<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Facades\Auth;

class Section extends Model
{
	use SoftDeletes;

    protected $guarded = ['id'];

    protected static function boot()
    {
    	parent::boot();

    	static::saving(function ($model) {
            $model->created_by = Auth::id();
        });
    }
}