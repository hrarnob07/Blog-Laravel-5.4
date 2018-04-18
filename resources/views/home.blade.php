@extends('layouts.app')
<style type="text/css">
    .ra{
          border-radius: 100%;
          max-width: 100px

       }

</style>

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

             @if(count($errors)>0)
           @foreach($errors->all() as $error)
              <div class="alert alert-denger">{{$error}}
              </div>
              @endforeach

            @endif

            @if(session('response'))
              <div class="alert alert-success">{{session('response')}}</div>

             @endif
            <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="row">
                    <div class="col-md-4">dashbord</div>
                    <div class="col-md-8">
                      


      <form  method="POST" action="{{ url("/search") }}">
          {{ csrf_field() }}

            <div class="form-group">
            <input type="text" name="search" class="form-controll" placeholder="search for ..">
            <span>
              <button type="submit" class="btn btn-default"  >
                      Search
                  </button>      
            </span>

            </div>
           
          
      </form> 





                    </div>

                  </div>
       
                </div>

                <div class="panel-body">
                   <div class="col-md-4">
                       @if(!empty($profile))

                         <p><img src="{{$profile->profile_pic}}" class="ra" alt=""></p>
                          @else
                               <p><img src="{{url('images/ra.jpg')}}" class="ra" alt=""></p>

                        @endif

                        @if(!empty($profile))

                       <p class="lead">{{$profile->name}}</p>
                          @else
                               

                        @endif

                         @if(!empty($profile))

                       <p class="lead">{{$profile->designation}}</p>
                          @else
                               

                        @endif


                       
                       
                   </div>
               <div class="col-md-8">
                          
          
               @if(count($posts)>0)
                 @foreach($posts->all() as $post)
                   <h1>{{$post->post_title}}</h1>
                    <img src="{{$post->post_image}}" alt="">
                    <p>{{substr($post->post_body,0,150)}}</p>
                     <ul class="nav nav-pills">
                       <li role="presentation">
                        <a href='{{url("/view/{$post->id}")}}'>
                        <span class="fas fa-eye"> VIEW </span>
                         </a>
                       </li>
                  @if(Auth::id()==1)
                       <li role="presentation">
                        <a href='{{url("/edit/{$post->id}")}}'>
                        <span class="fas fa-edit"> EDIT </span>
                         </a>
                       </li>
                       <li role="presentation">
                        <a href='{{url("/delete/{$post->id}")}}'>
                        <span class="fas fa-trash"> DELETE </span>
                         </a>
                       </li>
                   @endif

                     </ul>

                    <cite style="float: left;">Posted on : {{date('M j , Y H:i', strtotime($post->updated_at))}}</cite>
                    <hr/>

          @endforeach

        @endif
              {{ $posts->links() }}

               </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
