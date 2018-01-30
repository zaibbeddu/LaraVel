<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model{
    
    protected $fillable = [
        'album_name', 'description', 'album_thumb',
    ];
    //protected $table = 'albums'; // in caso il nomedella tabella non coincida con il nome della classe al plurale e con la prima lettera minuscola
    //protected $primaryKey = 'id' // in caso la chiave primaria non fosse con nome id
    
    public function getPathAttribute(){
        $url = $this->album_thumb;
        if (stristr($this->album_thumb, 'http') === false){
            $url = 'storage/'.env('ALBUM_THUMB_DIR')."/".$this->album_thumb;
        }
        return $url;
    }
    
    public function photos(){
        
        return $this->hasMany(Photo::class, 'album_id', 'id');
    }
}