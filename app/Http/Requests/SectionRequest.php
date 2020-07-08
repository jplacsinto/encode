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
        $sectionId = isset($this->section->id) ? $this->section->id : "";

        return [
        	'name' => 'required|max:255',
        	'slug' => "required|unique:sections,slug,{$sectionId}|max:255"
        ];
    }
}
