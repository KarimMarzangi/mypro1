@extends('layouts.app')
@section('head1')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
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
	        
    		<h1>List of Comment</h1>
    		
    		
			
			<table class="table table-striped">
				<thead>
				  <tr>
					<th>Id</th>
					<th>comment</th>
					<th>Sender</th>
					<th>Operation</th>
					
				  </tr>
				</thead>
				<tbody>

				@foreach ($comments as $comment)
				  <tr>
					<td>{{ $comment->id }}</td>
					<td>{{ $comment->comment }}</td>
					<td>{{ $comment->user()->first()->name }}</td>
					<td><a href="{{ route('delcomment', ['id'=>$comment->id]) }}">del</a></td>
				  </tr>
				@endforeach



				</tbody>
			  </table>  
			  
					
			  
		</div>
		
	</div>
	<br><br>
	{{ $comments->links('pagination::bootstrap-4') }}
</div>













@endsection