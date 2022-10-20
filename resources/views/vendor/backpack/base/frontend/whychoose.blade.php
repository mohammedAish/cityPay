@extends(backpack_view('blank'))

@include('backpack::base.inc.wallet_css')

@section('content')
    <button type="button" data-target="#newModal" data-toggle="modal" class="btn btn-success"><i class="fa fa-fw fa-plus"></i>Add New</button>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form action="{{ route('admin.frontend.update', $caption->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                        <div class="form-row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" placeholder="Member Name" name="title" value="{{ @$caption->value->title }}" required/>
                                </div>
                                <div class="form-group">
                                    <label>Short Details</label>
                                    <input type="text" class="form-control" placeholder="Member Designation" name="short_details" value="{{ @$caption->value->short_details }}" required/>
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


<div class="row">




    <div class="col-lg-12">
        <div class="card">
            <div class="table-responsive table-responsive-xl">
                <table class="table align-items-center table-light">
                    <thead>
                    <tr>
                        <th scope="col">Icon</th>
                        <th scope="col">Title</th>
                        <th scope="col">Subtitle</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody class="list">
                    @forelse($howItWorks as $item)
                        <tr>
                            <td>@php echo $item->value->icon; @endphp</td>
                            <td>{{ $item->value->title }}</td>
                            <td>{{ $item->value->sub_title }}</td>
                            <td>
                                <button type="button" class="btn btn-rounded btn-primary editBtn" data-title="{{ $item->value->title }}" data-icon="{{ $item->value->icon }}"
                                        data-sub_title="{{ $item->value->sub_title }}" data-action="{{ route('admin.frontend.update', $item->id) }}"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-danger removeBtn" data-id="{{ $item->id }}"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-muted text-center" colspan="100%">{{ $empty_message }}</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer py-4">
                <nav aria-label="...">
                    {{ $howItWorks->links() }}
                </nav>
            </div>

        </div>
    </div>


</div>

    {{-- New MODAL --}}
    <div id="newModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Social Icon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.frontend.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="key" value="whychoose">
                    <div class="modal-body">

                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title" required>
                        </div>
                        <div class="form-group">
                            <label>Subtitle</label>
                            <input type="text" class="form-control" name="sub_title" required>
                        </div>

                        <div class="form-group">
                            <label>Icon</label>
                            <div class="input-group has_append">
                                <input type="text" class="form-control" name="icon" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary iconPicker" data-icon="fas fa-home" role="iconpicker"></button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Edit MODAL --}}
    <div id="editModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Social Icon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST">
                    @csrf
                    <input type="hidden" name="key" value="whychoose">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title" required>
                        </div>

                        <div class="form-group">
                            <label>Subtitle</label>
                            <input type="text" class="form-control" name="sub_title" required>
                        </div>
                        <div class="form-group">
                            <label>Icon</label>
                            <div class="input-group has_append">
                                <input type="text" class="form-control" name="icon" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary iconPicker"     data-icon="fas fa-home" role="iconpicker"></button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


{{-- REMOVE METHOD MODAL --}}
<div id="removeModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Removal Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.frontend.remove') }}" method="POST">
                @csrf
                <input type="hidden" name="id">
                <div class="modal-body">
                    <p>Are you sure to remove this post?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Remove</button>
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('breadcrumb-plugins')
    <button type="button" data-target="#newModal" data-toggle="modal" class="btn btn-success"><i class="fa fa-fw fa-plus"></i>Add New</button>
@endpush

@push('after_styles')
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.3.1/css/all.css"/>
    <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap-iconpicker.min.css') }}">
@endpush



@push('after_scripts')
    <script src="{{ asset('assets/admin/js/bootstrap-iconpicker.bundle.min.js') }}"></script>

    <script>
        $('.removeBtn').on('click', function() {
            var modal = $('#removeModal');
            modal.find('input[name=id]').val($(this).data('id'))
            modal.modal('show');
        });

        $('.editBtn').on('click', function() {
            var modal = $('#editModal');
            modal.find('input[name=title]').val($(this).data('title'));
            modal.find('input[name=icon]').val($(this).data('icon'));
            modal.find('input[name=sub_title]').val($(this).data('sub_title'));
            modal.find('form').attr('action', $(this).data('action'));
            modal.modal('show');
        });

        $('#editModal').on('shown.bs.modal', function (e) { $(document).off('focusin.modal'); });
        $('#newModal').on('shown.bs.modal', function (e) { $(document).off('focusin.modal'); });

        $('.iconPicker').iconpicker({
            align: 'center', // Only in div tag
            arrowClass: 'btn-danger',
            arrowPrevIconClass: 'fas fa-angle-left',
            arrowNextIconClass: 'fas fa-angle-right',
            cols: 10,
            footer: true,
            header: true,
            icon: 'fas fa-bomb',
            iconset: 'fontawesome5',
            labelHeader: '{0} of {1} pages',
            labelFooter: '{0} - {1} of {2} icons',
            placement: 'bottom', // Only in button tag
            rows: 5,
            search: false,
            searchText: 'Search icon',
            selectedClass: 'btn-success',
            unselectedClass: ''
        }).on('change', function(e){
            $(this).parent().siblings('input[name=icon]').val(`<i class="${e.icon}"></i>`);
        });
    </script>

@endpush
