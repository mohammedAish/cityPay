@extends('layouts.org_web.layout')

@section('keywords')
    @if(current_local()=="en")
        <meta name="keywords" content=" {{ isset($header->home_keywords_en)?$header->home_keywords_en:'تداول' }}" />
    @else
        <meta name="keywords" content=" {{ isset($header->home_keywords)?$header->home_keywords:'تداول' }}" />
    @endif
@endsection

@section('content')

        <div class="container">
            <header  >
                <div style="position: relative; margin-top: 40px;">
            <img src="{{asset('org_assets/dist/img/courseheader.jpg')}}" class="img-fluid " style="max-width: 100%;  height: auto;">



                    <div class=" p-4 bd-highlight position-absolute d-flex flex-column " style="background-color: white;left: 4.8rem;
                        top: 6.4rem; max-width: 44rem; width: 400px;" >
                        <h1>Dream up</h1>
                        <p>some thing to descrip</p>
                        <div class="search-input mt-2 d-flex flex-column flex-md-row align-items-center">

                            <input type="text" class="form-control" placeholder="ماذا تريد ان تتعلم؟">
                            <button class="btn" type="submit">
                                <i class="fas fa-search" aria-hidden="true"></i>
                            </button>

                        </div>
                    </div>
                </div>

            </header>

        </div>

    <!-- Main content -->
    <div class="container">
        <section>
            <h3>The world's largest selection of courses</h3>
            <p>Choose from 155,000 online video courses with new additions published every month
            </p>
        </section>

        <section class="mt-5">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item " >
                    <a class="nav-link active" style="color: dimgrey" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
                </li>
                <li class="nav-item "  >
                    <a class="nav-link" style="color: dimgrey" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
                </li>
                <li class="nav-item"  >
                    <a class="nav-link" style="color: dimgrey" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="row col-md-12" style="border: darkgray 1px solid;border-radius: 5px ">
                    <div class="col-md-10 mt-4">
                    <h4>Expand your career opportunities with Python
                    </h4>
                    <p>Whether you work in machine learning or finance, or are pursuing a career in web development or data science, Python is one of the most important skills you can learn. Python's simple syntax is especially suited for desktop, web, and business applications. Python's design philosophy emphasizes readability and usability. Python was developed upon the premise that there should be only one way (and preferably one obvious way) to do things, a philosophy that has resulted in a strict level of code standardization. The core programming language is quite small and the standard library is also large. In fact, Python's large library is one of its greatest benefits, providing a variety of different tools for programmers suited for many different tasks.

                    </p>



                        <a href="#" class="btn mt-3" >تصفح هذا التصنيف</a>
                    </div>
                    <div class="col-md-2 mt-4">
                        <img src="{{asset('org_assets/dist/img/udemy.jpg')}}" width="150px" class="rounded">
                    </div>





                </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
            </div>
        </section>


    </div>


    <!-- Footer -->
@endsection
