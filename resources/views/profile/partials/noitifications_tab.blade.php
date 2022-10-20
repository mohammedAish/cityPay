<div class="card m-5 ">
    <div class="row ">
        <div class="col-md-12 ">
            <div class="page-title style-boder-titel-card d-flex flex-column   ">
                <h1 class="style-title-card px-4 py-4">
                                                <span class="fw-bolder mb-2 text-dark">
                                                    {{cp('authorization')}}
                                                </span>
                </h1>

            </div>
        </div>
    </div>

    <div class="card-body">

        <form>
            @csrf

            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-5">
                        <div class="fv-row mb-10">
                            <label class="fs-6 fw-bold form-label style-label-form mb-2"
                                   style="color:#1B3160;">{{cp('successful_license_notification')}}</label>
                            <select name="role" data-control="select2" data-placeholder="{{cp('disabled')}}"
                                    data-hide-search="true"
                                    class="form-select style-select-profile style-label-form  ">
                                <option value="1" @if(auth()->user()->confirmation_notification == 1) selected @endif>{{cp('enabled')}}</option>
                                <option value="0" @if(auth()->user()->confirmation_notification == 0) selected @endif>{{cp('disabled')}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 ">
                    <div class="page-title style-boder-titel-card d-flex flex-column   ">
                        <h1 class="style-title-card  py-4">
                                                    <span class="fw-bolder mb-2 text-dark">
                                                        {{cp('internal_transfers')}}
                                                    </span>
                        </h1>

                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-5 mt-5">
                        <div class="fv-row mb-5">
                            <label class="fs-6 fw-bold form-label style-label-form mb-2"
                                   style="color:#1B3160;">{{cp('incoming_payment_notification')}}</label>
                            <select name="incoming_payment_notification" id="incoming_payment_notification" data-control="select2" data-placeholder="{{cp('disabled')}}"
                                    data-hide-search="true"
                                    class="form-select style-select-profile style-label-form">
                                <option value="0" @if(auth()->user()->incoming_payment_notification == 0) selected @endif>{{cp('disabled')}}</option>
                                <option value="1" @if(auth()->user()->incoming_payment_notification == 1) selected @endif>{{cp('e-mail')}}</option>
                                {{--                            <option value="3">ارسال عبر الرسائل القصيرة(SMS)*</option>--}}
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-5 mb-5 mt-5">
                        <label class="style-label-form">{{cp('minimum_notification')}}</label>
                        <div class="input-group">
                            <input type="text" class="style-input-radiuse form-control" id="minimum_notification" name="minimum_notification" value="{{auth()->user()->minimum_notification}}"/>
                            <span class="input-group-text text-white style-select-profile-curreny"
                                  id="basic-addon2">
                                                        US
                                                    </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-5  my-4">
                        <div class="fv-row ">
                            <button id="notibtn" type="button"
                                    class="form-control BntAdd-Modal">{{cp('confirm')}}</button>
                            {{--                        <label class="pt-3 style-title-bio-card2 ">--}}
                            {{--                            <span style="color:#E51C39!important;">*</span>--}}
                            {{--                            تكلفة الرسالة الواحدة 0.05 دولار--}}
                            {{--                        </label>--}}
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>

<script>
    $(document).ready(function () {

        $('#notibtn').click(function () {
            let incoming_payment_notification = $('#incoming_payment_notification').find("option:selected").val();
            let minimum_notification = $('#minimum_notification').val();

            $.ajax({
                url: '{{route('update_notification')}}',
                type: "post",
                data: {
                    _token: '{{csrf_token()}}',
                    incoming_payment_notification: incoming_payment_notification,
                    minimum_notification: minimum_notification,
                },
                success: function (response) {
                    if (response.success) {
                        showSuccessModal(response.message)
                    }
                    // $('#kt_modal_enter_code_modal').modal('show')
                }, error: function (xhr) {
                    if (xhr.status === 422) {
                        let response = $.parseJSON(xhr.responseText);
                        $.each(response.errors, function (key, value) {
                            showErrorModal(value[0])
                        });
                    }
                },
            })
        });
    });
</script>