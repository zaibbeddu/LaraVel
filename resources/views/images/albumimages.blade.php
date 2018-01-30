@extends('templates.default')
@section('content')
	<h1>Albums photos</h1>
<table class="table">
	<thead class="thead-dark">
	<tr>
		<th>ID</th>
		<th>CREATED DATE</th>
		<th>TITLE</th>
		<th>ALBUM</th>
		<th>THUMBNAIL</th>
	</tr>
	</thead>
	@forelse($images as $image)
		<tr>
			<td>{{$image->id}}</td>
			<td>{{$image->created_at}}</td>
			<td>{{$image->name}}</td>
			<td>{{$album->album_name}}  <img width="50" alt="{{$album->album_name}}" title="{{$album->album_name}}" src="{{asset($album->Path)}}"></td>
			<td><img width="130" alt="{{$image->name}}" title="{{$image->name}}" src="{{asset($image->img_path)}}"></td>
		</tr>	
	@empty
		<tr>
			<td colspan="5">No images found</td>		
		</tr>
		
	@endforelse

</table>
@endsection