@extends('layouts.app')
@section('head1')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<style>
.comment1
{
	background-color: rgb(156, 16, 16);
	padding: 10px;
	border: 1px solid #666;
	border-radius: 5px;
	margin-bottom: 10px;
}
.require {
    color: #666;
}
label small {
    color: #999;
    font-weight: normal;
}





</style>
@endsection


@section('content')
@isset($messages)
	@foreach ($messages->all() as $msg)
		{{ $msg }}
	@endforeach
@endisset

	


<div class="container">
	<div class="row">
	    
	    <div class="col-md-10 col-md-offset-1">
	        
    		<h1>Details of Posts</h1>
    		

				<div class="card col-md-12 ">
					<div class="card-body">
						<h3 class="card-title">{{ $post->title }}</h3>
						<p class="card-text">{{ $post->description }}</p>
						<p class="card-text"><small class="text-muted">Auther: {{ $post->user()->first()->name }} </small></p>
						<p class="card-text"><small class="text-muted">Date: {{ $post->created_at->format('d/m/Y') }} </small></p>
						<p class="card-text"><small class="text-muted">#comment: 200</small></p>
					</div>
				</div>
<br><br>
				<h3>Create Comment</h3>
    		
				<form action="{{ route('creatingcomment',['id'=>$post->id]) }}" method="POST">
    		    
    		    
                @csrf
    		    
    		    
    		    
    		    <div class="form-group">
    		        <label for="comment">comment<span class="require">*</span></label>
    		        <textarea rows="5" class="form-control" name="comment" ></textarea>
    		    </div>
    		    
    		    <div class="form-group">
    		        <button type="submit" class="btn btn-primary">
    		            Create
    		        </button>
    		        
    		    </div>
    		    
    		</form>
			<br><br>	  
			 <h3>List of Comments</h3>
			 <br>

			 @foreach($comments as $comment)
			 <div class="comment1" style="background-color: rgb(230, 225, 225);padding: 10px;border: 1px solid #666;border-radius: 5px;margin-bottom: 10px;">
				<span class="card-text"><small class="text-muted">sender: {{ $comment->user()->first()->name }} </small></span>&nbsp;&nbsp;&nbsp;
				<span class="card-text"><small class="text-muted">Date: {{ $comment->created_at->format('d/m/Y') }} </small></span>
				<h5>	{{ $comment->comment }} </h5>

			 </div>
			 @endforeach
					
			  
		</div>
		
	</div>

</div>













@endsection