@extends(backpack_view('blank'))

@include('backpack::base.inc.wallet_css')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form action="{{ route('admin.frontend.bg.image.update') }}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                        <div class="form-row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Payment section background image</label>
                                    <div class="image-upload">
                                        <div class="thumb">
                                            <div class="avatar-preview">
                                                <div class="profilePicPreview"
                                                     style="background-image: url({{ get_image(config('constants.frontend.bgimage.path') .'/'. 'pm_bg_img.jpg') }})">
                                                    <button type="button" class="remove-image"><i
                                                                class="fa fa-times"></i></button>
                                                </div>
                                            </div>
                                            <div class="avatar-edit">
                                                <input type="file" class="profilePicUpload"
                                                       name="payment_background_image" id="profilePicUpload1">
                                                <label for="profilePicUpload1" id="uploadP" class="bg-primary">Upload
                                                    Image</label>
                                                <small class="mt-2 text-facebook">Supported files: <b>jpg,jpeg,png,</b>.
                                                    Image will be resized into
                                                    <b>{{ Config::get('constants.frontend.bgimage.size') }}px</b>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>How it work section background image</label>
                                    <div class="image-upload">
                                        <div class="thumb">
                                            <div class="avatar-preview">
                                                <div class="profilePicPreview"
                                                     style="background-image: url({{ get_image(config('constants.frontend.bgimage.path') .'/'. 'work_bg_img.jpg') }})">
                                                    <button type="button" class="remove-image"><i
                                                                class="fa fa-times"></i></button>
                                                </div>
                                            </div>
                                            <div class="avatar-edit">
                                                <input type="file" class="profilePicUpload"
                                                       name="how_it_work_background_image" id="profilePicUpload2">
                                                <label for="profilePicUpload2" class="bg-primary">Upload Image</label>
                                                <small class="mt-2 text-facebook">Supported files: <b>jpg,jpeg,png,</b>.
                                                    Image will be resized into
                                                    <b>{{ Config::get('constants.frontend.bgimage.size') }}px</b>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
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

