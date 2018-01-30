@extends('templates.default')
@section('content')
	<h1>Albums</h1>
	@if(session()->has('message'))
	@component('components.alert-info')
		{{session()->get('message')}}
		@endcomponent
	@endif
	<form>
	<input id="_token" name="_token" type="hidden" value="{{csrf_token()}}" >
	<ul class='list-group'>
		@foreach($albums as $album)
			<li class="list-group-item justify-content-between" >
				 <div class="row justify-content-between"> 
				
					({{$album->id}}) {{$album->album_name}}
					
				
				 <div> 
					@if($album->album_thumb)
						<img alt="{{$album->album_name}}" title="{{$album->album_name}}" src="{{asset($album->path)}}" width="60" >
					@endif
					@if($album->photos_count)
						<a href="/albums/{{$album->id}}/images" class="btn btn-primary"> ({{$album->photos_count}}) Immagini Album </a>
					@endif
					<a href="/albums/{{$album->id}}/edit" class="btn btn-primary"> Aggiorna </a>
					<a href="/albums/{{$album->id}}" id="delete_{{$album->id}}" class="btn btn-danger"> Delete </a>
				 </div>
				 </div> 
			</li>
		@endforeach
	</ul>
	</form>
@endsection

@section('footer')
	@parent
	<script type="text/javascript">

		$('div.alert').fadeOut(5000);
		$('document').ready(function(){
			$('[id^="delete_"]').click(function(ele) {
				ele.preventDefault();
				//alert(ele.target.href);
				var urlAlbum = $(this).attr('href');
				var li = ele.target.parentNode.parentNode;
				console.log($('#_token').val());
				$.ajax(
					urlAlbum,
					{
						method : 'DELETE',
						data : { _token : $('#_token').val()},
						complete : function (resp){
							console.log(resp);
							if (resp.responseText == 1) {
								//alert(resp.responseText);
								//li.parentNode.removeChild(div);
								//alert(li.parentNode);
								li.parentNode.remove();
								//li.parentNode.removeChild(li);
							} else {
								alert('Problem Contacting Server');
							}
						}
					}
				)
			})

		});
	</script>

@endsection