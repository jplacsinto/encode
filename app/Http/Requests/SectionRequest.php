<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SectionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
        	'name' => 'required|max:255',
        	'slug' => "required|unique:sections,slug,{$this->section->id}|max:255"
        ];
    }
}
