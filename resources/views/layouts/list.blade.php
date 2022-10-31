@extends('layouts.app')
@section('head1')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>

.require {
    color: #666;
}
label small {
    color: #999;
    font-weight: normal;
}
.card
{
	height: 250px;
}
</style>
@endsection


@section('content')


<div class="container">
	<div class="row">
	    
	    <div class="col-md-10 col-md-offset-1">
	        
    		<h1>List of Posts</h1>
    		
    		@foreach ($posts as $post)

				<div class="card col-md-4" style="float: left;">
					<div class="card-body">
						<a href="{{ route('postdetails', ['id'=>$post->id]) }}"><h3 class="card-title">{{ $post->title }}</h3></a>
						<p class="card-text">{{ $post->description }}</p>
						<p class="card-text"><small class="text-muted">Auther: {{ $post->user()->first()->name }} </small></p>
						<p class="card-text"><small class="text-muted">Date: {{ $post->created_at->format('d/m/Y') }} </small></p>
						<p class="card-text"><small class="text-muted">#comment: {{ $post->comments->count() }}</small></p>
					</div>
				</div>

			@endforeach
			
			  
			  
					
			  
		</div>
		
	</div>
	<br><br>
	{{-- {{ $posts->links('pagination::bootstrap-4') }} --}}
</div>













@endsection