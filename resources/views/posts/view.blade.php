@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
                    
            @if(session('response'))
              <div class="alert alert-success">{{session('response')}}</div>

             @endif
            
            <div class="panel panel-default">
                <div class="panel-heading">View Post</div>

                <div class="panel-body">
                   <div class="col-md-4">
                 	<ul class="list-group">
                    @if(count($categories)>0)
                      @foreach($categories ->all() as $category)
                      
                      	<li class="list-group-item"><a href="{{url("/category/{$category->id}")}}">
                      		{{$category->category}}
                      	</a></li>	
                      	

                      @endforeach

                    @else
                    @endif
                    </ul>

                   
                       
                   </div>
               <div class="col-md-8">
                          
                    
                      @if(count($posts)>0)
                       @foreach($posts->all() as $post)
                        <h4>{{$post->post_title}}</h4>
                        <img src="{{$post->post_image}}" alt="">
                         <p>{{$post->post_body}}</p>

                         <ul class="nav nav-pills">
                       <li role="presentation">
                        <a href='{{url("/like/{$post->id}")}}'>
                        <span class="fas fa-thumbs-up"> Like ({{$likecount}})</span>
                         </a>
                       </li>

                       <li role="presentation">
                        <a href='{{url("/dislike/{$post->id}")}}'>
                        <span class="fas fa-thumbs-down">Dislike ({{$dislikecount}})</span>
                         </a>
                       </li>
                       <li role="presentation">
                        <a href=''>
                        <span class="fas fa-comment-alt"> Comment </span>
                         </a>
                       </li>

                     </ul>

            
               <form  method="POST" action="{{ url("/comments/{$post->id}") }}">
        {{ csrf_field() }}

      <div class="form-group">
          <textarea id="comment"  rows="6" class="form-control" name="comment" value="{{ old('comment') }}"  required ></textarea>       
      </div>
            <div class="form-group">
              
                  <button type="submit" class="btn btn-primary btn-large btn-block"  >
                      Publish Comment
                  </button>               
              </div>
          
      </form> 



                         @endforeach

       
                         @else
                         <p>nothing is availabe</p>
                         @endif
                   
                    @if(count($comment)>0)
                      @foreach($comment ->all() as $comments)
                      <h3>Comments</h3><br/>
                      <p>Name :{{$comments->name}}</p>
                      {{$comments->comment}}
                       
                        

                      @endforeach

                    @else
                    @endif
                


               </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
