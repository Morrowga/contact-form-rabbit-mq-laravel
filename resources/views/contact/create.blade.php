@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-5">
                <div class="card-body">
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="form-group my-1">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control my-2">
                        </div>
                        <div class="form-group my-1">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control my-2">
                        </div>
                        <div class="form-group my-1">
                            <label for="">Description</label>
                            <textarea type="text" name="description" class="form-control my-2"></textarea>
                        </div>
                        <div class="form-group my-3 mx-5">
                            <button type="submit" class="btn btn-success btn-block w-100">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
