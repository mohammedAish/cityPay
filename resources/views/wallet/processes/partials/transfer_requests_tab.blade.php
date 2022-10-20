<div class="tab-pane fade show " id="transfer_requests_tab" role="tabpanel">
    <div class="card m-5 ">
        <div class="row ">
            <div class="col-md-12 ">
                <div class="page-title style-boder-titel-card d-flex flex-column   ">
                    <h1 class="style-title-card px-4 py-4">
                                                <span class="fw-bolder mb-2 text-dark">
                                                    طلبات التحويل
                                                </span>
                    </h1>

                </div>
            </div>
        </div>
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                                            <span class="svg-icon svg-icon-1 position-absolute style-icon-search-Teble-padd">
                                                <svg class="style-icon-search-Teble" xmlns="http://www.w3.org/2000/svg"
                                                     width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546"
                                                          height="2" rx="1" transform="rotate(45 17.0365 15.1223)"
                                                          fill="black"></rect>
                                                    <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                          fill="black"></path>
                                                </svg>
                                            </span>
                    <input type="text" data-kt-user-table-filter="search"
                           id="kt_project_Transfer_requests_Search_All"
                           class="form-control form-control-solid style-input-search-Data-Teable ps-14"
                           placeholder="ابحث هنا ...">
                </div>

            </div>
        </div>
        <div class="card-body">
            <div class="dataTables_wrapper style-boder-titel-Table dt-bootstrap4 no-footer">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer"
                           id="kt_project_Transfer_requests">
                        <thead>
                        <tr class="style-row-table">
                            <th class="min-w-125px style-Title-colume-table">تاريخ العملية</th>
{{--                            <th class="min-w-100px style-Title-colume-table">الوكالة</th>--}}
                            <th class="min-w-80px style-Title-colume-table">المبلغ</th>
{{--                            <th class="min-w-150px style-Title-colume-table">نوع العملية</th>--}}
                            <th class="min-w-80px style-Title-colume-table">رقم العملية</th>
                            <th class="min-w-125px style-Title-colume-table">الحالة</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($transfer_withdraw_order as $order)
                            <tr class="odd  style-row-table">
                                <td class="style-text-row-table">{{$order->created_at->format('Y/m/d')}}</td>
{{--                                <td class="style-text-row-table">Paypal</td>--}}
                                <td class="style-text-row-table">${{$order->final_amount}}</td>
{{--                                <td class="style-text-row-table">{{$order->receiving_mode == 'cash' ? 'كاش' : 'بنك إلكتروني'}}</td>--}}
                                <td class="style-text-row-table">{{$order->id}}</td>
{{--                                <td class="style-text-row-table">--}}
{{--                                    <button type="button" class="btn" data-bs-toggle="modal"--}}
{{--                                            data-bs-target="#kt_modal_Transfer_requests">--}}
{{--                                        3--}}
{{--                                    </button>--}}
{{--                                </td>--}}
                                <td class="style-text-row-table">
                                    @if($order->current_status == 'pending')
                                        <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="7.5" cy="7.5" r="6.5" stroke="#E51C39" stroke-width="1.5"/>
                                            <path d="M7.86089 4.25003C7.86089 4.44946 7.69922 4.61114 7.49978 4.61114C7.30035 4.61114 7.13867 4.44946 7.13867 4.25003C7.13867 4.05059 7.30035 3.88892 7.49978 3.88892C7.69922 3.88892 7.86089 4.05059 7.86089 4.25003Z"
                                                  fill="#E51C39" stroke="#E51C39" stroke-width="1.5"/>
                                            <path d="M7.5 11.111V6.05542" stroke="#E51C39" stroke-width="1.5"/>
                                        </svg>
                                        <span class="px-1">قيد الانتظار</span>
                                    @else
                                        <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5.33388 6.05569L7.48087 7.66594C7.89934 7.97979 8.48899 7.91811 8.83344 7.52444L13.2783 2.44458"
                                                  stroke="#3ABE32" stroke-width="1.5" stroke-linecap="round"></path>
                                            <path d="M14 7.5C14 8.85813 13.5746 10.1822 12.7835 11.2861C11.9924 12.3901 10.8754 13.2185 9.58936 13.655C8.3033 14.0916 6.9128 14.1144 5.61315 13.7201C4.3135 13.3259 3.16998 12.5344 2.3432 11.4569C1.51642 10.3795 1.04792 9.07008 1.00348 7.71267C0.959043 6.35527 1.34091 5.01804 2.09545 3.88879C2.84999 2.75955 3.93929 1.89501 5.21037 1.41661C6.48146 0.938209 7.87047 0.869972 9.18232 1.22148"
                                                  stroke="#3ABE32" stroke-width="1.5" stroke-linecap="round"></path>
                                        </svg>
                                        <span class="px-1">{{cp('completed')}}</span>
                                    @endif    
                                    
                                </td>
                            </tr>
                        @endforeach    

                        </tbody>
                        <!--end::Table body-->
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>