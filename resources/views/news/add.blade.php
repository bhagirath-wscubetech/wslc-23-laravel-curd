@extends('layouts.main')
@section('main-part')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Add News</h6>
            </div>
            <div class="card-body">
                <h4 class="text-center text-danger">
                    <ul class="list-unstyled">
                        {{-- {{p($errors)}} --}}
                        {{-- @foreach ($errors->all() as $error)
                            <li>
                                {{ $error }}
                            </li>
                        @endforeach --}}
                    </ul>
                </h4>
                <form method="post" action="{{ url('/news/add') }}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <label for="" class="form-lable">Title</label>
                            <input type="text" name="news_title" class="form-control" value="{{ old('news_title') }}">
                            <span class="text-danger">
                                {!! $errors->get('news_title')[0] ?? '' !!}
                            </span>
                        </div>
                        <div class="col-12 mt-2">
                            <label for="" class="form-lable">Description</label>
                            <textarea name="news_desc" required id="editor" class="form-control" cols="30" rows="10">{{ old('news_desc') }}</textarea>
                            <span class="text-danger">
                                {!! $errors->get('news_desc')[0] ?? '' !!}
                            </span>
                        </div>
                        <div class="col-12 mt-2">
                            <button class="btn btn-primary" type="submit" name="save" value="clicked">
                                Add
                            </button>
                            <button class="btn btn-warning" type="reset">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('news_desc');
    </script>
@endpush
