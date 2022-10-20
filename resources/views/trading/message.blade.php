@extends('layouts.org_web.layout')
@section('content')

    <div class="wallet-box-scroll " style="margin-top: 100px;">

        <div class="container">
            <div class="row justify-content-center ">

                <div class=" col-md-9 ">
                    <div class="blog-comment-form ">
                        <div class="comment-title">
                            <h3 class="text-center mb-5" >يرجى ارسال بريد الكتروني الئ FBS</h3>
                            <p> بما ان حسابك ليس في مجموعة IB لدينا وللبدء في كسب الكصومات  بما ان حسابك ليس في مجموعة بما ان حسابك ليس في مجموعة بما ان حسابك ليس في مجموعة بما ان حسابك ليس في مجموعة</p>

                            <form action="#">
                                <h5 style="display: inline-block">ارسال الى : </h5>
                                <span>email.com</span>
                                <br>
                                <h5 style="display: inline-block">الموضوع : </h5>
                                <span>ضع حسابي تحت fbbs</span>
                                <textarea name="message" placeholder="Write Comment" id="comment-form" cols="30" rows="10" disabled style=" overflow: auto;"> هنا الرساله حق الشركة</textarea>
                                <button type="submit" class="template-button">ارسال</button>
                            </form>

                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>



@endsection
