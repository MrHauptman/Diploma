<?php

namespace App\Http\Requests;
use App\Models\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class DestroyFilesRequest extends ParentIdBaseRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'all' =>'nullable|bool',
            'ids.*'=> Rule::exists('files','id')->where(function($query){
                $query->where('created_by', Auth::id());

            })
        ]);    
        
    }
}
