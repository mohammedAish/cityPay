@extends(backpack_view('blank'))

@include('backpack::base.inc.wallet_css')

@section('content')
<div class="row">

    <div class="col-xl-12">
        <div class="card">
            <form action="{{ route('admin.frontend.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">


                    <div class="row">
                        <div class="col-md-4">

                            <div class="form-group">
                                <div class="image-upload">
                                    <div class="thumb">
                                        <div class="avatar-preview">
                                        <div class="profilePicPreview" style="background-image: url({{ get_image(config('constants.frontend.seo.path') .'/'. $post->value->image) }})">
                                                <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                            </div>
                                        </div>
                                        <div class="avatar-edit">
                                            <input type="file" class="profilePicUpload" name="image_input" id="profilePicUpload1" accept=".png, .jpg, .jpeg">
                                            <label for="profilePicUpload1" class="bg-primary">Upload Social Images</label>
                                            <small class="mt-2 text-facebook">Image will be resized into <b>{{ config('constants.frontend.seo.size') }}px</b></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">

                            <div class="form-group">
                                <label>Meta Keywords</label>
                                <small class="ml-2 mt-2 text-facebook">Separate multiple keywords by <code>,</code>(comma) or <code>enter</code> key</small>
                                <select name="keywords[]" class="form-control select2-auto-tokenize" placeholder="Add short words which better describe your site" multiple="multiple" required>
                                    @foreach($post->value->keywords as $option)
                                    <option value="{{ $option }}" selected>{{ $option }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>Meta Description</label>
                                <textarea name="description" rows="3" class="form-control" placeholder="SEO meta description" required>{{ $post->value->description }}</textarea>
                            </div>
                        
                            <div class="form-group">
                                <label>Social Title</label>
                                <input type="text" class="form-control" placeholder="Social Share Title" name="social_title" value="{{ $post->value->social_title }}" required/>
                            </div>



                            <div class="form-group">
                                <label>Social Description</label>
                                <textarea name="social_description" rows="3" class="form-control" placeholder="Social Share  meta description" required>{{ $post->value->social_description }}</textarea>
                            </div>

                           

                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-block btn-primary mr-2">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection