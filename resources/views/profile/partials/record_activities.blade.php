<div class="card m-5 ">
    <div class="row ">
        <div class="col-md-12 ">
            <div class="page-title style-boder-titel-card d-flex flex-column   ">
                <h1 class="style-title-card px-4 py-4">
                                                <span class="fw-bolder mb-2 text-dark">
                                                    {{cp('activities')}}
                                                </span>
                </h1>

            </div>
        </div>
    </div>

    <div class="card-body">

        <div class="dataTables_wrapper dt-bootstrap4 no-footer">
            <div class="table-responsive">
                <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer"
                       id="kt_Record_activities_Table">

                    <thead>

                    <tr class="style-row-table">

                        <th class="w-300px style-Title-colume-table">{{cp('transaction')}}</th>

                        <th class="w-100px style-Title-colume-table">{{cp('date')}}</th>
                        <th class="w-100px style-Title-colume-table">{{cp('time')}}</th>

                    </tr>

                    </thead>

                    <tbody>

                    @foreach($activities as $activity)
                        <tr class="odd  style-row-table">
                            <td class="style-text-row-table-activities" style="color: #000;">
                                @if($activity->type == 1)
                                    <svg width="26" height="26" viewBox="0 0 26 26" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="13" cy="13" r="13" fill="#C4FFC1"/>
                                        <path d="M13.0003 18.8332C16.222 18.8332 18.8337 16.2215 18.8337 12.9998C18.8337 9.77818 16.222 7.1665 13.0003 7.1665C9.77866 7.1665 7.16699 9.77818 7.16699 12.9998C7.16699 16.2215 9.77866 18.8332 13.0003 18.8332Z"
                                              stroke="#20AB18" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M15.3337 12.9998L13.0003 10.6665L10.667 12.9998"
                                              stroke="#20AB18" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M13 15.3332V10.6665" stroke="#20AB18" stroke-linecap="round"
                                              stroke-linejoin="round"/>
                                    </svg>
                                @else
                                    <svg width="26" height="26" viewBox="0 0 26 26" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="13" cy="13" r="13" fill="#FFDBDB"/>
                                        <path d="M11.25 18.25H8.91667C8.60725 18.25 8.3105 18.1271 8.09171 17.9083C7.87292 17.6895 7.75 17.3928 7.75 17.0833V8.91667C7.75 8.60725 7.87292 8.3105 8.09171 8.09171C8.3105 7.87292 8.60725 7.75 8.91667 7.75H11.25"
                                              stroke="#E81919" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M15.333 15.9168L18.2497 13.0002L15.333 10.0835"
                                              stroke="#E81919" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M18.25 13H11.25" stroke="#E81919" stroke-linecap="round"
                                              stroke-linejoin="round"/>
                                    </svg>
                                @endif
                                {{cp($activity->key)}} {{$activity->created_at->format('Y/m/d')}}
                            </td>

                            <td class="style-text-row-table">{{$activity->created_at->format('Y/m/d')}}</td>
                            <td class="style-text-row-table">{{$activity->created_at->format('H:i:s')}}</td>
                        </tr>
                    @endforeach    
                    
{{--                    <tr class="odd  style-row-table">--}}
{{--                        <td class="style-text-row-table-activities" style="color: #000;">--}}
{{--                            <svg width="26" height="26" viewBox="0 0 26 26" fill="none"--}}
{{--                                 xmlns="http://www.w3.org/2000/svg">--}}
{{--                                <circle cx="13" cy="13" r="13" fill="#FFDBDB"/>--}}
{{--                                <path d="M11.25 18.25H8.91667C8.60725 18.25 8.3105 18.1271 8.09171 17.9083C7.87292 17.6895 7.75 17.3928 7.75 17.0833V8.91667C7.75 8.60725 7.87292 8.3105 8.09171 8.09171C8.3105 7.87292 8.60725 7.75 8.91667 7.75H11.25"--}}
{{--                                      stroke="#E81919" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                                <path d="M15.333 15.9168L18.2497 13.0002L15.333 10.0835"--}}
{{--                                      stroke="#E81919" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                                <path d="M18.25 13H11.25" stroke="#E81919" stroke-linecap="round"--}}
{{--                                      stroke-linejoin="round"/>--}}
{{--                            </svg>--}}
{{--                            لقد قمت بسجيل دخول في المحفظة بتاريخ 12/10/2021--}}
{{--                        </td>--}}

{{--                        <td class="style-text-row-table">08/24/20021</td>--}}
{{--                        <td class="style-text-row-table">01:34:22</td>--}}
{{--                    </tr>--}}


                    </tbody>
                    <!--end::Table body-->
                </table>
            </div>
        </div>

    </div>
</div>