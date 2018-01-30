<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use App\Models\Photo;

class AlbumsController extends Controller
{
    //
    public function index( Request $request ){

        //return Album::all();
        //1 $sql ='select * from albums WHERE 1=1';
        $queryBuilder = Album::orderBy('id','DESC')->withCount('photos');
        /*2$queryBuilder = DB::table('albums')->orderBy('id','DESC');*/
        if ($request->has('id')){
            $queryBuilder->where('id','=',$request->input('id'));
        }
        if ($request->has('album_name')){
            $queryBuilder->where('album_name','like',"%".$request->input('album_name')."%");
        }
        
        
        $albums = $queryBuilder->get();
        return view('albums.albums', ['albums' => $albums]);  
        /*1
        $where = [];

        if ($request->has('id')){
            $where['id'] = $request->get('id');
            $sql .= " AND `id`=:id";

        }
        if ($request->has('album_name')){
            $where['album_name'] = $request->get('album_name');
            $sql .= " AND `album_name`=:album_name";

        }
        $sql .= " ORDER BY id DESC";
        //dd($sql);
        $albums = DB::select($sql, $where);
        //dd($albums);
        return view('albums.albums', ['albums' => $albums]);1*/
    }

    public function delete(Album $id){
        //$sql = 'DELETE FROM albums WHERE id=:id';
        //2$res = DB::table('albums')->where('id',$id)->delete();
        //3$res = Album::where('id',$id)->delete();
        
        //4$album = Album::find($id);
        $fileName = $id->album_thumb;
        $disk = config('filesystems.default'); 
        $res = $id->delete();
        if ($res){
            
            if (Storage::disk($disk)->get(env('ALBUM_THUMB_DIR')."/".$fileName)){
                Storage::disk($disk)->delete(env('ALBUM_THUMB_DIR')."/".$fileName);
            }
        }
        //return DB::delete($sql, ['id' => $id]);
        return ''.$res;
        //return Redirect::back();
    }
    public function show($id){
        //$sql = 'SELECT * FROM albums WHERE id=:id';
        //2$res = DB::table('albums')->where('id', $id)->get();
        $res = Album::where('id', $id)->get();
        //return DB::select($sql, ['id' => $id]);
        return $res;
    }
    public function edit($id){
        //$sql = 'SELECT * FROM albums WHERE id=:id';
        //2$album = DB::table('albums')->where('id', $id)->get();
        //3$album = Album::where('id', $id)->get();
        //$album = DB::select($sql, ['id' => $id]);
        $album = Album::find($id);
        return view('albums.edit',['album' => $album]);
        // 23 return view('albums.edit',['album' => $album[0]]);
        //$sql = 'UPDATE albums WHERE id=:id';
        //return DB::update($sql, ['id' => $id]);
    }
    public function store($id, Request $req){
        //dd($req,$id);
        /*2$res = DB::table('albums')->where('id',$id)->update(
                [
                    'album_name' => request()->input('name'),
                    'description' => request()->input('description')
                ]
            );2*/
        /*3$res = Album::where('id',$id)->update(
            [
                'album_name' => request()->input('name'),
                'description' => request()->input('description')
            ]
            );3*/
        
         $album = Album::find($id);
         $album->album_name = request()->input('name');
         $album->description = request()->input('description');
         
         $this->processFile($id, $req, $album);
         
         
         $res = $album->save();
         
        /*$data = request()->only(['name','description']);
        $data['id'] = $id;
        $sql ='UPDATE albums SET album_name=:name, description=:description WHERE id=:id';
        $res = DB::update($sql, $data);*/
        
        $messaggio = $res ? 'Album con id = '.$id.' Aggiornato' : 'Album con id = '.$id.' Non Aggiornato';
        session()->flash('message',$messaggio);
        return redirect()->route('albums');
        //dd($res);
    }
    /**
     * @param id
     * @param req
     * @param album
     */private function processFile($id,Request $req, &$album):bool
    {
        if (!$req->hasFile('album_thumb')){
            return false;
        }
        $file = $req->file('album_thumb');
        if (!$file->isValid('album_thumb')){
            return false;
        }
        
        //$fileName = $file->store(env('ALBUM_THUMB_DIR'), 'public');
        $fileName = $id.".".$file->extension();
        $album->album_thumb = $fileName;
        $file->storeAs(env('ALBUM_THUMB_DIR'), $fileName, 'public');
        return true;                
             
    }

    public function create(){
        $album = new Album();
        return view('albums.createalbum',['album' => $album]);
    }
    
    public function save(Request $req){
        //dd(request()->all());
        //$data = request()->only(['name','description','album_thumb']);
        $data = $req;
        $data['user_id'] = 1;
        /*$sql = 'INSERT INTO albums (album_name,description,user_id)';
        $sql .= ' VALUES (:name,:description,:user_id)';
        
        $res = DB::insert($sql,$data);*/
        /*2$res = DB::table('albums')->insert(
            [
                'album_name' => $data['name'],
                'description' => $data['description'],
                'user_id' => $data['user_id']
            ]
            );2*/
        
        /*3$res = Album::insert(
            [
                'album_name' => $data['name'],
                'description' => $data['description'],
                'user_id' => $data['user_id']
            ]
            );3*/
        $album = new Album();
        $album->album_name = $data['name'];
        $album->description = $data['description'];
        $album->user_id = $data['user_id'];
        
        
        
        
        
        $res = $album->save();
        
        if ($res){
            $album->album_thumb ='';
            if ($this->processFile($album->id, $req, $album)){
                $album->save();
            }
        }
        
        $messaggio = $res ? 'Album con Nome = '.$data['name'].' Inserito' : 'Album con Nome = '.$data['name'].' Non Inserito';
        session()->flash('message',$messaggio);
        return redirect()->route('albums');
        
    }
    
    public function getImages(Album $album){
       
        $images = Photo::where('album_id',$album->id)->get();
        //return $images;
        return view('images.albumimages',compact('album','images'));
        
    }

}
