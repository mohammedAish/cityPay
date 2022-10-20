@extends(backpack_view('blank'))

@include('backpack::base.inc.wallet_css')

@push('style-lib')
    <link href="{{ asset('assets/admin/css/bootstrap-fileinput.css') }}" rel="stylesheet">
@endpush
@push('script')
    <script src="{{ asset('assets/admin/js/bootstrap-fileinput.js') }}"></script>
@endpush
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <form action="{{ route('admin.frontend.about.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Title </label>
                                <input type="text" class="form-control" placeholder="Write Title" name="title" value="{{@$post->value->title }}" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Sub Title </label>
                                <input type="text" class="form-control" placeholder="Write Sub Title" name="sub_title" value="{{@$post->value->sub_title }}" />
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Details </label>
                                <textarea name="details" class="form-control nicEdit" placeholder="Write content" cols="30" rows="10">{{ @$post->value->details }}</textarea>
                            </div>
                        </div>

                            <div class="col-md-6">
                                <label>Image </label><br>
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">
                                            <img style="width: 200px" src="{{asset('assets/images/frontend/about/about.jpg')}}" alt="...">

                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                    <div>
                                                <span class="btn btn-info btn-file">
                                                    <span class="fileinput-new bold uppercase"><i class="fa fa-file-image-o"></i> Select image</span>
                                                    <span class="fileinput-exists bold uppercase"><i class="fa fa-edit"></i> Change</span>
                                                    <input type="file" name="image" accept="image/*" >
                                                </span>
                                        <a href="#" class="btn btn-danger fileinput-exists bold uppercase" data-dismiss="fileinput"><i class="fa fa-trash"></i> Remove</a>
                                    </div>
                                </div>
                                @if ($errors->has('image'))
                                    <div class="error">{{ $errors->first('image') }}</div>
                                @endif

                            </div>



                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-row justify-content-center">
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-block btn-primary mr-2">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
