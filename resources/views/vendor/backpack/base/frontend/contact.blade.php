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
                                <label>Contact Title </label>
                                <input type="text" class="form-control" placeholder="Write content" name="title" value="{{@$post->value->title }}" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Short Details </label>
                                <input type="text" class="form-control" placeholder="Write content" name="short_details" value="{{@$post->value->short_details }}" />
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Form Heading </label>
                                <input type="text" class="form-control" placeholder="Write content" name="form_heading" value="{{ @$post->value->form_heading }}" />
                            </div>
                        </div>



                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Email Address </label>
                                <input type="text" class="form-control" placeholder="Write content" name="email_address" value="{{@$post->value->email_address }}" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Contact Address </label>
                                <input type="text" class="form-control" placeholder="Write content" name="contact_details" value="{{@$post->value->contact_details }}" />
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Contact Number </label>
                                <input type="text" class="form-control" placeholder="Write content" name="contact_number" value="{{@$post->value->contact_number }}" />
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
