@extends('templates.default')
@section('content')

<h1>Edit</h1>
	<form action="/albums/{{$album->id}}" method="POST" enctype="multipart/form-data">
	    {{csrf_field()}}
	    <input type="hidden" name="_method" value="PATCH">
		<div class="form-group">
			<label for="">Name</label>
			<input type="text" name="name" id="name" value="{{$album->album_name}}" class="form-control" placeholder="Album Name" >
		</div>

		@include('albums.partials.fileupload')
		
		<div class="form-group">
			<label for="">Description</label>
			<textarea name="description" id="description" class="form-control" placeholder="Album description" >{{$album->description}}</textarea>
		</div>
	
		<button type="submit" class="btn-btn-primary">Aggiorna</button>
	</form>


@endsection