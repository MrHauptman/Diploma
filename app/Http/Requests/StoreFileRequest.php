<?php

namespace App\Http\Requests;

use App\Models\File;
use Illuminate\Foundation\Http\FormRequest;

class StoreFileRequest extends ParentIdBaseRequest
{
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return array_merge(parent::rules(),[
           'files.*' =>[
            'required',
            'file',
            function($attribute,$value, $fail) 
            {
                $file = File::query()->where('name',$value->getClientOriginalName())
                ->where('parent_id', $this->parent_id)
                ->whereNull('deleted_at')
                ->exists();
                
                if ($file) {
                    $fail('File "' . $value->getClientOriginalName() . '" already exists.');
                }
            }
           ]
        ]);
    }
}
