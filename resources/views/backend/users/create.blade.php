@extends('layouts.dashboard');
@section('main')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">{{__('Create User')}}</h5>
                <div class="card-body">
                    <form class="needs-validation" novalidate method="post" action="{{ url('backend/users/store') }}">
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
                                <label for="validationCustom01">{{__('Name')}}</label>
                                <input type="text" class="form-control" name="username" placeholder="Name" aria-describedby="inputGroupPrepend" required>
                                <div class="invalid-feedback">
                                    {{__('please fill  out this field')}}
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-b-10">
                                <label for="validationCustom01">{{__('Email')}}</label>
                                <input type="email" class="form-control" name="email" placeholder="Email" aria-describedby="inputGroupPrepend" required>
                                <div class="invalid-feedback">
                                    {{__('please fill  out this field')}}
                                </div>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-b-10">
                                <label for="validationCustom01">{{__('Password')}}</label>
                                <input type="password" class="form-control" name="password" placeholder="Password" aria-describedby="inputGroupPrepend" required>
                                <div class="invalid-feedback">
                                    {{__('please fill  out this field')}}
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-b-10">
                                <label for="validationCustom01">{{__('Password Again')}}</label>
                                <input type="password" class="form-control" name="passwordAgain" placeholder="Password" aria-describedby="inputGroupPrepend" required>
                                <div class="invalid-feedback">
                                    {{__('please fill  out this field')}}
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-b-10">
                                <label for="validationCustom01">{{__('Birthday')}}</label>
                                <input type="date" class="form-control" name="birthday" placeholder="Birthday" aria-describedby="inputGroupPrepend" required>
                                <div class="invalid-feedback">
                                    {{__('please fill  out this field')}}
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-b-10">
                                <label for="validationCustom01">{{__('Phone')}}</label>
                                <input type="text" class="form-control" name="phone" placeholder="Phone">
                            </div>
                        </div>
                        <div class="col-sm-12 pl-0 p-t-10">
                            <p class="text-right">
                                <button type="submit" class="btn btn-space btn-primary">{{__('Submit')}}</button>
                                <a href="{{ route('backend.users.index') }}"  class="btn btn-space btn-secondary">{{__('Cancel')}}</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
@endsection