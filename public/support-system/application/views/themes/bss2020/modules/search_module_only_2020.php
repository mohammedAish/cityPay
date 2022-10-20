<section class="home-header no-pad <?php echo getThemeAPIValue_2020('_src_style','bss2020_head_20'); ?>">
	<div class="<?php echo get_app_container_type();?>">
        <h1>
			<?php if(!empty($__icon_class)){?>
                <i class="<?php echo $__icon_class;?>"></i>
			<?php }?>
			<?php echo !empty($_title)?$_title:""; ?>
			<?php if(!empty($_subTitle)){?>
                <small><?php echo $_subTitle;?></small>
			<?php }?>
        </h1>
		<div id="header-src-box" class="header-src-box">
			<input type="text" id="app-src-input" class="src-input" placeholder="Ask You Question" aria-label="" aria-describedby="">
			<span class="header-src-icon"> <i class="fa fa-search"></i></span>

            <div id="app-src-container" class="src-container style-1 text-left " style="display: none; z-index: 90;">
                <div class="" style="margin-top: -11px;position: absolute;left: 0;right: 0;top: 16px;">
                    <div class="card card-default">
                        <div class="card-body">
                            <div class="app-loader bar-black sm-loader" style="display: none;">
                                <div class="bar1"></div><div class="bar2"></div><div class="bar3"></div><div class="bar4"></div><div class="bar5"></div><div class="bar6"></div>
                            </div>
                            <div class=" app-src-list-content text-center" >
                                <?php echo getThemeAPIValue_2020('_src_rdy_msg','Ready To Search'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</section>
<script type="text/javascript">
    jQuery(function(){
        $("#app-src-input").on('focusin',function(e) {
            $("#app-src-container").show();
            $("#header-src-box").addClass('active');
        });
        $("#app-src-input").keyup(function(e) {
            e.stopPropagation()
            var va=$(this).val();
            //console.log(va);
            if(va.length>2){
                var data={src:va};
                showSrcLoader();
                search_delay(function(){
                    $.ajax({
                        url: appGlobalLang.src_url,
                        data: set_csrf_param(data),
                        type: "POST",
                        scriptCharset: "utf-8",
                        dataType: "json",
                        beforeSend: function() {

                        },
                        success: function(rdata) {
                            app_set_src_list(rdata);
                        },
                        complete: function(jqXHR, textStatus) {
                            showSrcLoader(true);
                        }
                    });
                }, 600 );
            }else{
                //close_src_panel();
            }
        });

        $('body').on('click', function (e) {
            var $target = e.target;
            var container=$("#header-src-box");
            if (!$($target).is(container) && !$($target).is(container.children())) {
                close_src_panel();
            }
        });
        $(".src-main-container").on("click",function(e){
            e.stopPropagation();
        });
    });
    function showSrcLoader(is_hide){
        if(typeof is_hide =="undefined"){
            is_hide=false;
        }
        if(is_hide){
            $("#app-src-container").removeClass("app-srced");
            $("#app-src-container .app-loader").hide();
        }else{
            $("#app-src-container").addClass("app-srced");
            $("#app-src-container .app-src-list-content").hide();
            $("#app-src-container .app-loader").fadeIn();
        }
    }
    function close_src_panel(is_force){
        if(typeof is_force =="undefined"){
            is_force=false;
        }
        $("#header-src-box").removeClass('active');
        if(is_force || !$("#app-src-container").hasClass("app-srced")){
            $("#app-src-container").removeClass("app-srced").hide();
            $("#app-src-container .app-loader").fadeOut();

        }
    }
    var search_delay = (function(){
        var timer = 0;
        return function(callback, ms){
            clearTimeout (timer);
            timer = setTimeout(callback, ms);
        };
    })();
    function app_set_src_list(items){
        //gcl(items.length);
        if(items.total>0){
            var htmltext=gen_app_src_ul(items);
            $("#app-src-container .app-src-list-content").removeClass("text-center").html(htmltext);
        }else{
            $("#app-src-container .app-src-list-content").addClass("text-center").html("<?php _e("No search result found") ?>");
        }
        $("#app-src-container .app-src-list-content").show();
    }
    function gen_app_src_ul(items){

        if(items.total>0){
            var ulstr='<ul class="kn-list">';
            for(var i=0; i<items.data.length;i++){
                ulstr+='<li class="   ">\
    		<div class="kn-title">\
    			<h3 class="m-0">\
    			<a href="'+items.data[i].href+'">'+items.data[i].title+'</a>\
    			 <span class="cat-container" >in '+items.data[i].cat_link+'</span>\
    				<span class="kn-like float-right text-success"><i class="fa fa-thumbs-up "></i> '+items.data[i].l_count+'</span>\
    		</h3>\
    		</div>\
    	</li>';
            }
            if(items.total>items.data.length){
                ulstr+='<li class=" p-5  text-center"><a href="'+items.full_url+'">Total Result ('+items.total+')</a></li>';
            }
            ulstr+='</ul>';
            return ulstr;
        }else{
            return '';
        }
    }
</script>