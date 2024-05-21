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
use Illuminate\Support\Facades\Storage;

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
        static::deleted(function( File $model){
            if (!$model->is_folder) {
            Storage::delete($model->storage_path);
            }
        });
 
   }


   
   public function owner(): Attribute
   {
       return Attribute::make(
           get: function (mixed $value, array $attributes) {
               return $attributes['created_by'] == Auth::id() ? 'Я' : $this->user->name;
           }
       );
   }
   public function get_file_size()
   {
       $units = ['B', 'KB', 'MB', 'GB', 'TB'];

       $power = $this->size > 0 ? floor(log($this->size, 1024)) : 0;

       return number_format($this->size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
   }
   public function deleteForever()
   {
       $this->deleteFilesFromStorage([$this]);
       $this->forceDelete();
   }

   public function deleteFilesFromStorage($files)
   {
       foreach ($files as $file) {
           if ($file->is_folder) {
               $this->deleteFilesFromStorage($file->children);
           } else {
               Storage::delete($file->storage_path);
           }
       }
   }
   public function starred()
    {
        return $this->hasOne(StarredFile::class, 'file_id', 'id')
            ->where('user_id', Auth::id());
    }
    public static function getSharedWithMe()
    {
        return File::query()
            ->select('files.*')
            ->join('file_shares', 'file_shares.file_id', 'files.id')
            ->where('file_shares.user_id', Auth::id())
            ->orderBy('file_shares.created_at', 'desc')
            ->orderBy('files.id', 'desc');
    }

    public static function getSharedByMe()
    {
        return File::query()
            ->select('files.*')
            ->join('file_shares', 'file_shares.file_id', 'files.id')
            ->where('files.created_by', Auth::id())
            ->orderBy('file_shares.created_at', 'desc')
            ->orderBy('files.id', 'desc')
            ;
    }
}
