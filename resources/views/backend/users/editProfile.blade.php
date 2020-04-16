@extends('layouts.dashboard');
@section('main')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">{{__('Edit Profile')}}</h5>
                <div class="card-body">
                    <form class="needs-validation" novalidate method="post" enctype="multipart/form-data" action="{{ url('backend/users/updateProfile') }}">
                        @csrf
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-b-5">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            {{ $error }}<br>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-b-10">
                                <label for="exampleFormControlFile1">Image</label>
                                <input type="file" class="form-control-file" name="photo">
                            </div>

                        </div>
                        <div class="col-sm-12 pl-0 p-t-10">
                            <p class="text-right">
                                <button type="submit" class="btn btn-space btn-primary">{{__('Update')}}</button>
                                <button class="btn btn-space btn-secondary">{{__('Cancel')}}</button>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection