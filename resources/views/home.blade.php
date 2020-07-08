@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($errors->any())
            <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
            </div>
            @endif
            @if (session('success'))
            <div class="alert alert-success">{{session('success')}}</div>
            @endif
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" name="image[]" multiple class="custom-file-input">
                        <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                    </div>
                    <div class="input-group-append">
                        <button class="btn btn-success" type="submit">Upload</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row mt-5">
        @foreach ($galleries as $gallery)
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <img src="{{asset('upload/'.$gallery->name)}}"class="rounded mx-auto d-block" width="300" height="300">
                </div>
                <div class="card-footer">
                    <a href="{{asset('upload/'.$gallery->name)}}" target="_blank" class="btn btn-info">View</a>
                    <a href="{{route('home.download',$gallery->id)}}" class="btn btn-success">Download</a>
                    <a href="{{route('home.destroy',$gallery->id)}}" class="btn btn-danger float-right" onclick="return confirm('Are you sure you want to Delete?');">Delete</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
