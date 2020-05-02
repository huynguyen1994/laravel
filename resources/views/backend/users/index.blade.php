@extends('layouts.dashboard');
@section('main')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">{{__('Dashboard')}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{__('Users')}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    @if ( Session::has('success') )
        <div class="alert alert-success alert-dismissible" role="alert">
            <strong>{{ Session::get('success') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
        </div>
    @endif
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12">
            <div class="card">
                <div >
                    <a href="{{ url('backend/users/create') }}"  style="float:right" class="btn btn-primary mt-1 mr-2 fas fa-plus-square"></a>
                    <h5 class="card-header">{{__('Table Users')}}</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="bg-light">
                            <tr class="border-0">
                                <th class="border-0">STT</th>
                                <th class="border-0">NAME</th>
                                <th class="border-0">EMAIL</th>
                                <th class="border-0">BIRTHDAY</th>
                                <th class="border-0">PHONE</th>
                                <th class="border-0">Image</th>
                                <th class="border-0">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if ($users)
                                <?php $i = 1; ?>
                                @foreach ($users as $item)
                            <tr>
                                <td >{{ $i++ }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->birthday }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>
                                    <?php $images = json_decode($item->image); ?>
                                    @if ($item->image)
                                    <picture>
                                        <source srcset="{{ asset('images/users/'. $images->webp) }}" type="image/webp">
                                        <source srcset="{{ asset('images/users/'. $images->image) }}" type="image/jpg">
                                        <img src="{{ asset('images/users/'. $images->image) }}" width="100">
                                    </picture>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('backend/users/edit', $item->id) }}" class="btn btn-success fas fa-edit"></a>
                                    <a href="{{ url('backend/users/destroy', $item->id) }}" class="btn btn-danger  fas fa-trash"></a>
                                </td>
                            </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                        <div  class="p-l-20 p-t-10" id="example2_paginate">
                            {!! $users->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection