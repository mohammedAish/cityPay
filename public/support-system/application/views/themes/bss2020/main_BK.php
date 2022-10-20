<!DOCTYPE html>
<html lang="en" dir="<?php echo Mapp_setting::GetSettingsValue("is_rtl_client")=="Y"?"rtl":"ltr"; ?>" >
<head>
    <meta charset="UTF-8">
    <title>Support New UI</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,400;0,700;1,100;1,300&family=Open+Sans:ital,wght@0,300;0,700;1,300&display=swap" rel="stylesheet">
    <?php
	    if(!empty($meta)){
		    foreach($meta as $name=>$content){
			    if(empty($content))continue;
			    echo "\n\t\t";
			    ?><meta name="<?php echo $name; ?>" content="<?php echo $content; ?>" /><?php
		    }}
	    echo "\n";
	
	    if(!empty($canonical))
	    {
		    echo "\n\t\t";
		    ?><link rel="canonical" href="<?php echo $canonical?>" /><?php
		
	    }
	    echo "\n\t";
	
	    foreach($css as $file){
		    echo "\n\t\t";
		    ?><link rel="stylesheet" href="<?php echo $file; ?>" type="text/css" /><?php
	    } echo "\n\t";
	
	    foreach($js as $file){
		    echo "\n\t\t";
		    ?><script src="<?php echo $file; ?>"></script><?php
	    } echo "\n\t";
    ?>
</head>
<body>

<header>
    <!-- Fixed navbar -->
    <nav id="main-nav" class="navbar navbar-expand-md   ">
        <div class="container">
            <a class="navbar-brand" href="#">BDTHEMES</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="col">
                    <ul class="navbar-nav d-flex justify-content-center ">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                    </ul>
                </div>
                <div class="text-center">
                    <a href="#" class="btn btn-sm btn-login">Login</a>
                    <a href="#" class="btn btn-sm btn-register">Register</a>
                </div>
            </div>
        </div>
    </nav>


</header>

<section class="home-header">
    <div class="container">
        <h1>Looking for help?</h1>
        <p>KnowAll is a fully featured knowledge base theme for WordPress.</p>
        <div class="header-src-box">
            <input type="text" class="" placeholder="Ask You Question" aria-label="" aria-describedby="">
            <span class="header-src-icon"> <i class="fa fa-search"></i></span>
        </div>
    </div>
</section>
<div class="container">
    <section id="still-need-section" class="still-need-section d-box-shadow">

        <div class="row">
            <div class="col-sm text-center">
                <h2>Still Need Support? </h2>
                <p>We normally response within 24 hours</p>
            </div>
            <div class="col-sm text-center pt-3">
                <a href="" class="btn btn-lg btn-theme-light"><i class="fa fa-ticket"></i> Support Ticket</a>
            </div>
        </div>

    </section>
</div>
<section id="feature-box-container" class="feature-box-container section-mt">
    <div class="container">
        <div class="row">

            <div class="col-sm">
                <div class="feature-box d-box-shadow ">
                    <div class="f-icon">
                        <i class="fa fa-address-book"></i>
                    </div>
                    <div class="f-title">Community Forums</div>
                    <div class="f-content">Some dodgy chav bevvy amongst
                        argy-bargy spiffing absolutely bladdered
                        nancy boy cup of tea a load of old
                        tosh porkies.</div>
                    <div class="f-btn">
                        <a href=""><i class="fa fa-long-arrow-right"></i></a>
                    </div>

                </div>


            </div>
            <div class="col-sm ">
                <div class="feature-box d-box-shadow">
                    <div class="f-icon">
                        <i class="fa fa-address-book"></i>
                    </div>
                    <div class="f-title">Documentation</div>
                    <div class="f-content">Some dodgy chav bevvy amongst
                        argy-bargy spiffing absolutely bladdered
                        nancy boy cup of tea a load of old
                        tosh porkies.</div>
                    <div class="f-btn">
                        <a href=""><i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-sm ">
                <div class="feature-box d-box-shadow">
                    <div class="f-icon">
                        <i class="fa fa-address-book"></i>
                    </div>
                    <div class="f-title">Knowledge Base</div>
                    <div class="f-content">Some dodgy chav bevvy amongst
                        argy-bargy spiffing absolutely bladdered
                        nancy boy cup of tea a load of old
                        tosh porkies.</div>
                    <div class="f-btn">
                        <a href=""><i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section id="before-article" class="section-mt text-center">
    <div class="container">
        <h2>Check out our guide categories</h2>
        <p>Some dodgy chav bevvy amongst argy-bargy spiffing absolutely bladdered
            nancy boy cup of tea a load of old tosh porkies.</p>
    </div>
</section>
<?php 	echo $output;  ?>
<section id="article-container" class="article-container section-mt-h">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 article-box">
                <h2 class="art-title">
                    Recent Articles
                </h2>
                <div class="art-list">
                    <ul class="">
                        <li><a href="#"><i class="fa fa-file-text-o"></i> Creating a Multilingual Site In Joomla!</a></li>
                        <li><a href="#"><i class="fa fa-file-text-o"></i> Creating a Multilingual Site In Joomla! How to Install Joomla Quick start Package</a></li>
                        <li><a href="#"><i class="fa fa-file-text-o"></i> Creating a Multilingual Site In Joomla!</a></li>
                        <li><a href="#"><i class="fa fa-file-text-o"></i> Creating a Multilingual Site In Joomla!</a></li>
                        <li><a href="#"><i class="fa fa-file-text-o"></i> Creating a Multilingual Site In Joomla!</a></li>
                    </ul>
                </div>
                <div class="text-center pt-3">
                    <a href="" class="btn btn-sm btn-theme-light"><i class="fa fa-ticket"></i>View All</a>
                </div>
            </div>
            <div class="col-sm-4 article-box">
                <h2 class="art-title">
                    Recent Articles
                </h2>
                <div class="art-list">
                    <ul class="">
                        <li><a href="#"><i class="fa fa-file-text-o"></i> Creating a Multilingual Site In Joomla!</a></li>
                        <li><a href="#"><i class="fa fa-file-text-o"></i> Creating a Multilingual Site In Joomla! How to Install Joomla Quick start Package</a></li>
                        <li><a href="#"><i class="fa fa-file-text-o"></i> Creating a Multilingual Site In Joomla!</a></li>
                        <li><a href="#"><i class="fa fa-file-text-o"></i> Creating a Multilingual Site In Joomla!</a></li>
                        <li><a href="#"><i class="fa fa-file-text-o"></i> Creating a Multilingual Site In Joomla!</a></li>
                    </ul>
                </div>
                <div class="text-center pt-3">
                    <a href="" class="btn btn-sm btn-theme-light"><i class="fa fa-ticket"></i>View All</a>
                </div>
            </div>
            <div class="col-sm-4 article-box">
                <h2 class="art-title">
                    Recent Articles
                </h2>
                <div class="art-list">
                    <ul class="">
                        <li><a href="#"><i class="fa fa-file-text-o"></i> Creating a Multilingual Site In Joomla!</a></li>
                        <li><a href="#"><i class="fa fa-file-text-o"></i> Creating a Multilingual Site In Joomla! How to Install Joomla Quick start Package</a></li>
                        <li><a href="#"><i class="fa fa-file-text-o"></i> Creating a Multilingual Site In Joomla!</a></li>
                        <li><a href="#"><i class="fa fa-file-text-o"></i> Creating a Multilingual Site In Joomla!</a></li>
                        <li><a href="#"><i class="fa fa-file-text-o"></i> Creating a Multilingual Site In Joomla!</a></li>
                    </ul>
                </div>
                <div class="text-center pt-3">
                    <a href="" class="btn btn-sm btn-theme-light"><i class="fa fa-ticket"></i>View All</a>
                </div>
            </div>
        </div>

        <div class="row section-mt-h">
            <div class="col-sm-4 article-box">
                <h2 class="art-title">
                    Recent Articles
                </h2>
                <div class="art-list">
                    <ul class="">
                        <li><a href="#"><i class="fa fa-file-text-o"></i> Creating a Multilingual Site In Joomla!</a></li>
                        <li><a href="#"><i class="fa fa-file-text-o"></i> Creating a Multilingual Site In Joomla! How to Install Joomla Quick start Package</a></li>
                        <li><a href="#"><i class="fa fa-file-text-o"></i> Creating a Multilingual Site In Joomla!</a></li>
                        <li><a href="#"><i class="fa fa-file-text-o"></i> Creating a Multilingual Site In Joomla!</a></li>
                        <li><a href="#"><i class="fa fa-file-text-o"></i> Creating a Multilingual Site In Joomla!</a></li>
                    </ul>
                </div>
                <div class="text-center pt-3">
                    <a href="" class="btn btn-sm btn-theme-light"><i class="fa fa-ticket"></i>View All</a>
                </div>
            </div>
            <div class="col-sm-4 article-box">
                <h2 class="art-title">
                    Recent Articles
                </h2>
                <div class="art-list">
                    <ul class="">
                        <li><a href="#"><i class="fa fa-file-text-o"></i> Creating a Multilingual Site In Joomla!</a></li>
                        <li><a href="#"><i class="fa fa-file-text-o"></i> Creating a Multilingual Site In Joomla! How to Install Joomla Quick start Package</a></li>
                        <li><a href="#"><i class="fa fa-file-text-o"></i> Creating a Multilingual Site In Joomla!</a></li>
                        <li><a href="#"><i class="fa fa-file-text-o"></i> Creating a Multilingual Site In Joomla!</a></li>
                        <li><a href="#"><i class="fa fa-file-text-o"></i> Creating a Multilingual Site In Joomla!</a></li>
                    </ul>
                </div>
                <div class="text-center pt-3">
                    <a href="" class="btn btn-sm btn-theme-light"><i class="fa fa-ticket"></i>View All</a>
                </div>
            </div>
            <div class="col-sm-4 article-box">
                <h2 class="art-title">
                    Recent Articles
                </h2>
                <div class="art-list">
                    <ul class="">
                        <li><a href="#"><i class="fa fa-file-text-o"></i> Creating a Multilingual Site In Joomla!</a></li>
                        <li><a href="#"><i class="fa fa-file-text-o"></i> Creating a Multilingual Site In Joomla! How to Install Joomla Quick start Package</a></li>
                        <li><a href="#"><i class="fa fa-file-text-o"></i> Creating a Multilingual Site In Joomla!</a></li>
                        <li><a href="#"><i class="fa fa-file-text-o"></i> Creating a Multilingual Site In Joomla!</a></li>
                        <li><a href="#"><i class="fa fa-file-text-o"></i> Creating a Multilingual Site In Joomla!</a></li>
                    </ul>
                </div>
                <div class="text-center pt-3">
                    <a href="" class="btn btn-sm btn-theme-light"><i class="fa fa-ticket"></i>View All</a>
                </div>
            </div>
            <div class="col-sm-4 article-box">
                <h2 class="art-title">
                    Recent Articles
                </h2>
                <div class="art-list">
                    <ul class="">
                        <li><a href="#"><i class="fa fa-file-text-o"></i> Creating a Multilingual Site In Joomla!</a></li>
                        <li><a href="#"><i class="fa fa-file-text-o"></i> Creating a Multilingual Site In Joomla! How to Install Joomla Quick start Package</a></li>
                        <li><a href="#"><i class="fa fa-file-text-o"></i> Creating a Multilingual Site In Joomla!</a></li>
                        <li><a href="#"><i class="fa fa-file-text-o"></i> Creating a Multilingual Site In Joomla!</a></li>
                        <li><a href="#"><i class="fa fa-file-text-o"></i> Creating a Multilingual Site In Joomla!</a></li>
                    </ul>
                </div>
                <div class="text-center pt-3">
                    <a href="" class="btn btn-sm btn-theme-light"><i class="fa fa-ticket"></i>View All</a>
                </div>
            </div>
            <div class="col-sm-4 article-box">
                <h2 class="art-title">
                    Recent Articles
                </h2>
                <div class="art-list">
                    <ul class="">
                        <li><a href="#"><i class="fa fa-file-text-o"></i> Creating a Multilingual Site In Joomla!</a></li>
                        <li><a href="#"><i class="fa fa-file-text-o"></i> Creating a Multilingual Site In Joomla! How to Install Joomla Quick start Package</a></li>
                        <li><a href="#"><i class="fa fa-file-text-o"></i> Creating a Multilingual Site In Joomla!</a></li>
                        <li><a href="#"><i class="fa fa-file-text-o"></i> Creating a Multilingual Site In Joomla!</a></li>
                        <li><a href="#"><i class="fa fa-file-text-o"></i> Creating a Multilingual Site In Joomla!</a></li>
                    </ul>
                </div>
                <div class="text-center pt-3">
                    <a href="" class="btn btn-sm btn-theme-light"><i class="fa fa-ticket"></i>View All</a>
                </div>
            </div>
        </div>
        <div class="row section-mt-h">
            <div class="col-sm text-center">
                <a href="" class="btn btn-lg btn-theme-light"><i class="fa fa-ticket"></i>View All Categories</a>
            </div>
        </div>
    </div>
</section>

<section id="faq-section" class="faq-section section-mt  section-ptb-h carosel-padding">
    <div class="container">
        <div class="faq-heading  text-center">
            <h2>How long will you take?</h2>
            <p>Find quicke answers to frequent pre-sale questions asked by customers</p>
        </div>
        <div class="faq-tab-container">
            <ul class="nav nav-c mb-3 justify-content-center" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-contact-tab3" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-contact-tab4" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="faq-item">
                                <a class="faq-qus collapsed" type="button" data-toggle="collapse" data-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample">
                                    Are updates and bug fixes included in the cost of the item?
                                </a>
                                <div class="collapse faq-ans" id="collapseExample1">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                </div>
                            </div>
                            <div class="faq-item">
                                <a class="faq-qus collapsed" type="button" data-toggle="collapse" data-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample3">
                                    Button with data-target
                                </a>
                                <div class="collapse faq-ans" id="collapseExample3">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="faq-item">
                                <a class="faq-qus collapsed" type="button" data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample2">
                                    Button with data-target
                                </a>
                                <div class="collapse faq-ans" id="collapseExample2">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="tab-pane fade show" id="pills-profile" role="tabpane2" aria-labelledby="pills-profile-tab">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="faq-item">
                                <a class="faq-qus collapsed" type="button" data-toggle="collapse" data-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample">
                                    Tab2 Are updates and bug fixes included in the cost of the item?
                                </a>
                                <div class="collapse faq-ans" id="collapseExample1">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                </div>
                            </div>
                            <div class="faq-item">
                                <a class="faq-qus collapsed" type="button" data-toggle="collapse" data-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample3">
                                    Button with data-target
                                </a>
                                <div class="collapse faq-ans" id="collapseExample3">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="faq-item">
                                <a class="faq-qus collapsed" type="button" data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample2">
                                    Button with data-target
                                </a>
                                <div class="collapse faq-ans" id="collapseExample2">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>
</section>

<div class="container">
    <section id="feedback-carousel" class="feedback-carousel d-box-shadow">

        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="text-center feed-img-container">
                        <img src="<?php echo base_url('theme/bss2020/images/ttt.jpg'); ?>" alt="" class="feed-img rounded-circle">
                    </div>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci animi consequuntur dignissimos est exercitationem explicabo facilis, harum impedit laboriosam maiores, nulla possimus provident quibusdam ratione reiciendis totam, ullam ut voluptatibus?
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae ex nulla sed voluptate. Aspernatur assumenda eius et, fuga harum inventore iste laudantium officiis quia tempore! Esse ipsa nulla praesentium unde!
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae ex nulla sed voluptate. Aspernatur assumenda eius et, fuga harum inventore iste laudantium officiis quia tempore! Esse ipsa nulla praesentium unde!
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae ex nulla sed voluptate. Aspernatur assumenda eius et, fuga harum inventore iste laudantium officiis quia tempore! Esse ipsa nulla praesentium unde!
                    </p>
                    <div class="feed-author">
                        <div class="feed-autor-name">
                            Sarwar Hasan
                        </div>
                        <div class="feed-autor-designation">
                            CEO, Appsbd.com
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="text-center feed-img-container">
                        <i class="fa fa-quote-right feed-img"></i>
                    </div>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci animi consequuntur dignissimos est exercitationem explicabo facilis, harum impedit laboriosam maiores, nulla possimus provident quibusdam ratione reiciendis totam, ullam ut voluptatibus?
                    </p>
                    <div class="feed-author">
                        <div class="feed-autor-name">
                            Sarwar Hasan
                        </div>
                        <div class="feed-autor-designation">
                            CEO, Appsbd.com
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="text-center feed-img-container">
                        <i class="fa fa-quote-right feed-img"></i>
                    </div>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci animi consequuntur dignissimos est exercitationem explicabo facilis, harum impedit laboriosam maiores, nulla possimus provident quibusdam ratione reiciendis totam, ullam ut voluptatibus?
                    </p>
                    <div class="feed-author">
                        <div class="feed-autor-name">
                            Sarwar Hasan
                        </div>
                        <div class="feed-autor-designation">
                            CEO, Appsbd.com
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <i class="fa fa-angle-left"></i>


            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">

                <i class="fa fa-angle-right"></i>
            </a>
        </div>

    </section>
</div>
<footer class="pt-4 my-md-5 pt-md-5">
    <div class="container">
        <div class="row row-cols-sm-4 justify-content-center">
            <div class="col">
                <div class="footer-mod">
                    <h4 class="mod-title">Company</h4>
                    <div class="mod-links">
                        <a href="#">About us</a>
                        <a href="#">Testimonial</a>
                        <a href="#">Affiliates</a>

                    </div>
                </div>

            </div>
            <div class="col">
                <div class="footer-mod">
                    <h4 class="mod-title">Company</h4>
                    <div class="mod-links">
                        <a href="#">Partners</a>
                        <a href="#">Careers</a>
                        <a href="#">Link 4</a>
                    </div>
                </div>

            </div>
            <div class="col">
                <div class="footer-mod">
                    <h4 class="mod-title">Company</h4>
                    <div class="mod-links">
                        <a href="#">About us</a>
                        <a href="#">Testimonial</a>
                        <a href="#">Affiliates</a>
                    </div>
                </div>

            </div>

            <div class="col">
                <div class="footer-mod">
                    <h4 class="mod-title">Company</h4>
                    <div class="mod-links">
                        <a href="#">About us</a>
                        <a href="#">Testimonial</a>
                        <a href="#">Affiliates</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</footer>
<div class="call-to-act-list">
    <button id="goToTop" class="call-to-action">
        <i class="fa fa-angle-double-up"></i>
    </button>
</div>

<script src="jquery/3.3.1/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/theme.js"></script>
</body>
</html>