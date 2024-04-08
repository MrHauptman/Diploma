<?php

namespace App\Models;

use App\Traits\HasCreatorAndUpdater;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;

class File extends Model
{
    use HasFactory,NodeTrait,SoftDeletes,HasCreatorAndUpdater;

    public function isOWnedBy($userId): bool  {
        
        return $this->created_by == $userId;

        
        
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(File::class, 'parent_id');
    }

    public function isRoot()
    {

        return $this-> parent_id === null;
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function($model) 
        {
            if(!$model->parent)
            {
                return;
            }
            $model->path = ( !$model->parent->isRoot() ? $model->parent->path . '/' : '' ) . Str::slug($model->name);
        });
 
   }
   public function owner(): Attribute
   {
       return Attribute::make(
           get: function (mixed $value, array $attributes) {
               return $attributes['created_by'] == Auth::id() ? 'me' : $this->user->name;
           }
       );
   }

}
