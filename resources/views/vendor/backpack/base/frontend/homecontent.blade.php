@extends(backpack_view('blank'))

@include('backpack::base.inc.wallet_css')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form action="{{ route('admin.frontend.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label> Title </label>
                                    <input type="text" class="form-control" placeholder="Write content" name="title" value="{{@$post->value->title }}" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label> Sub Title </label>
                                    <input type="text" class="form-control" placeholder="Write content" name="sub_title" value="{{@$post->value->sub_title }}" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label> Details </label>
                                    <textarea name="details" class="form-control nicEdit" placeholder="Write content" cols="30" rows="10">{{@$post->value->details }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label> Web Footer </label>
                                    <textarea name="web_footer" class="form-control " placeholder="Write content"  rows="4">{{@$post->value->web_footer }}</textarea>
                                </div>
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

@push('style')
    <style>
        .user-image {
            width: 200px;
            height: 200px;
        }
    </style>
@endpush

