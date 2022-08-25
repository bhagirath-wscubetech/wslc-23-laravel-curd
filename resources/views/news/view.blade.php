@extends('layouts.main')


@section('main-part')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">View News</h6>
            </div>
            <h4 class="text-center text-danger">
                <ul class="list-unstyled">
                    {{-- {{p($errors)}} --}}
                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </h4>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <td>Sr.</td>
                            <td>Title</td>
                            <td width="40%">Description</td>
                            <td>Status</td>
                            <td>Created At</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sr = 1;
                        @endphp
                        @foreach ($news as $data)
                            <tr>
                                <td>
                                    {{ $sr++ }} {{-- print and increment --}}
                                </td>
                                <td>{{ $data->title }}</td>
                                {{-- <td>{{$data->description}}</td>  echo --}}
                                <td>{!! $data->description !!}</td>
                                {{-- html_entity_decode() --}}
                                <td>
                                    <a href="{{ url('/news/toggle') }}/{{ $data->id }}">
                                        @if ($data->status == 1)
                                            <button class="btn btn-primary">Active</button>
                                        @else
                                            <button class="btn btn-warning">Inactive</button>
                                        @endif
                                    </a>
                                </td>
                                <td>{{ $data->created_at }}</td>
                                <td>
                                    <i class="text-primary fa fa-pen"></i>
                                    <br />
                                    <a href="{{ url('/news/destroy') }}/{{ $data->id }}">
                                        <i class="text-danger fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
