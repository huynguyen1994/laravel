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

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 p-b-10">
                                <label for="exampleFormControlFile1">Image</label>
                                <input type="file" class="form-control-file"
                                       onchange="previewFile()"
                                       name="image" id="image">
                                <input hidden input="text" value="{{ $user->id }}" name="userId">
                            </div>
                            @if ($images)
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <picture>
                                        <source srcset="{{ asset('public/images/users/'. $images->webp) }}" type="image/webp">
                                        <source srcset="{{ asset('public/images/users/'. $images->image) }}" type="image/jpeg">
                                        <img src="{{ asset('public/images/users/'. $images->image) }}" width="100">
                                    </picture>
                                </div>
                                @endif
                        </div>
                        <div class="col-sm-12 pl-0 p-t-10">
                            <p class="text-right">
                                <button type="submit" class="btn btn-space btn-primary">{{__('Update')}}</button>
                                <a href="{{ route('backend.users.index') }}"  class="btn btn-space btn-secondary">{{__('Cancel')}}</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
    function previewFile(event) {
        const preview = document.querySelector('img');
        const file = document.querySelector('input[type=file]').files[0];
        const reader = new FileReader();
        reader.addEventListener("load", function () {
            preview.src = reader.result;
        }, false);
        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection