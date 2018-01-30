		@if($album->album_thumb)
			<div class="form-group">
				<img width="320" alt="{{$album->album_name}}" title="{{$album->album_name}}" src="{{asset($album->Path)}}">
			</div>	
		@endif		
		
		<div class="form-group">
			<label for="">Thumbnail</label>
			<input type="file" name="album_thumb" id="album_thumb" value="" class="form-control" placeholder="Album Thumbnail" >
		</div>