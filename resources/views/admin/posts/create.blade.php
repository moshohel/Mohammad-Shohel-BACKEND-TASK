@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>
                            Create Post

                            <a href="{{ url('admin/posts') }}" class="btn btn-default pull-right">Go Back</a>
                        </h2>
                    </div>

                    <div class="panel-body">
                        {{-- {!! Form::open(['url' => '/admin/posts', 'class' => 'form-horizontal', 'role' => 'form']) !!} --}}

                        <div class="card">
                            <div class="card-header">
                                Create Post
                            </div>
                            <div class="card-body">
                              <form action="{{ route('blog.store') }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                  <label for="title">title</label>
                                  <input type="text" class="form-control" name="title" id="title" aria-describedby="emailHelp" placeholder="Enter title">
                                </div>

                                <div class="form-group">
                                    <label for="body">body</label>
                                    <input type="text" class="form-control" name="body" id="body" aria-describedby="emailHelp" placeholder="Enter body">
                                  </div>

                                <button type="submit" class="btn btn-primary">Create Tag</button>
                              </form>
                            </div>
                          </div>
                        {{-- {!! Form::close() !!} --}}
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
