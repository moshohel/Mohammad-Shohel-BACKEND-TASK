@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>
                            Create Tag

                            <a href="{{ url('admin/tags') }}" class="btn btn-default pull-right">Go Back</a>
                        </h2>
                    </div>


                    <div class="card">
                        <div class="card-header">
                            Create Tag
                        </div>
                        <div class="card-body">
                          <form action="{{ route('tag.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                              <label for="name">Name</label>
                              <input type="text" class="form-control" name="name" id="name" aria-describedby="emailHelp" placeholder="Enter Tag">
                            </div>

                            <button type="submit" class="btn btn-primary">Create Tag</button>
                          </form>
                        </div>
                      </div>

                </div>
            </div>

        </div>
    </div>
@endsection
