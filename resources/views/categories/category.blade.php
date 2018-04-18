@extends('layouts.app')

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
                <div class="panel-heading">category</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                 <form class="form-horizontal" method="POST" action="{{ url('/addcategory') }}">

                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                            <label for="category" class="col-md-4 control-label">Enter Categorys</label>

                            <div class="col-md-6">
                                <input id="category" type="categpry" class="form-control" name="category" value="{{ old('category') }}" required autofocus>

                               
                            </div>
                        </div>

                       
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                   Submit
                                </button>

                             
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
