//import { log } from "util";

$(window).on('load', function () {
  background();

});

$(document).ready(function () {

  // select2 example
  $('.select2-basic').select2();

  $('.select2-multi-select').select2();

  $(".select2-auto-tokenize").select2({
    tags: true,
    tokenSeparators: [',']
  });

  // js code for responsive drop-down-menu-item with swing effect
  $(".nav-item>a, .nav-item>ul>li>a").on("click", function () {
    var element = $(this).parent("li");
    if (element.hasClass("open")) {
      element.removeClass("open");
      element.find("li").removeClass("open");
    }
    else {
      element.addClass("open");
      element.siblings("li").removeClass("open");
      element.siblings("li").find("li").removeClass("open");
    }
  });

  // progress bar
  $(".progressbar").each(function () {
    $(this).find(".bar").animate({
      "width": $(this).attr("data-perc")
    }, 3000)
  });

// sidebar scroll
    $('#main-sidebar').slimScroll({
        height: '100vh'
    });

});

$(function () {
  var todoListItem = $('.todo-list');
  var todoListInput = $('.todo-list-input');
  $('.todo-list-add-btn').on("click", function (event) {
    event.preventDefault();
    var item = $(this).prevAll('.todo-list-input').val();
    if (item) {
      todoListItem.append("<li><div class='form-check'><label class='form-check-label'><input class='checkbox' type='checkbox'/>" + item + "<i class='input-helper'></i></label></div><i class='remove fa fa-times'></i></li>");
      todoListInput.val("");
    }
  });
  todoListItem.on('change', '.checkbox', function () {
    if ($(this).attr('checked')) {
      $(this).removeAttr('checked');
    } else {
      $(this).attr('checked', 'checked');
    }
    $(this).closest("li").toggleClass('completed');
  });
  todoListItem.on('click', '.remove', function () {
    $(this).parent().remove();
  });

});

$(".navbar-toggler").on('click', function () {
  $(".main-container").toggleClass("nav-close");
});

$(".main-sidebar .sidebar-close").on('click', function () {
  $(".main-container").removeClass("nav-close");
});

// // sidebar scroll
// $('#main-sidebar').slimScroll({
//   height: '100vh'
// });

$('#navbar_search').on('input', function () {
  var search = $(this).val().toLowerCase();
  var search_result_pane = $('#navbar_search_result_area .navbar_search_result');
  $(search_result_pane).html('');
  if (search.length == 0) {
    return;
  }
  // search
  var match = $('.main-sidebar .nav-link').filter(function (idx, elem) {
    return $(elem).text().trim().toLowerCase().indexOf(search) >= 0 ? elem : null;
  }).sort();
  // show search result
  // search not found
  if (match.length == 0) {
    $(search_result_pane).append('<li class="text-muted">No search result found.</li>');
    return;
  }
  // search found
  match.each(function (idx, elem) {
    var item_url = $(elem).attr('href') || $(elem).data('default-url');
    var item_text = $(elem).text().replace(/(\d+)/g, '').trim();
    $(search_result_pane).append(`<li><a href="${item_url}">${item_text}</a></li>`);
  });
});

function proPicURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      var preview = $(input).parents('.thumb').find('.profilePicPreview');
      $(preview).css('background-image', 'url(' + e.target.result + ')');
      $(preview).addClass('has-image');
      $(preview).hide();
      $(preview).fadeIn(650);
    }
    reader.readAsDataURL(input.files[0]);
  }
}
$(".profilePicUpload").on('change', function () {
  proPicURL(this);
});

$(".remove-image").on('click', function () {
  $(this).parents(".profilePicPreview").css('background-image', 'none');
  $(this).parents(".profilePicPreview").removeClass('has-image');
  $(this).parents(".thumb").find('input[type=file]').val('');
});


// registration form label animation

$('#reg-email').on('input', function () {
  var emailfield = $(this).val();
  if (emailfield.length < 1) {
    $('#reg-email').removeClass('hascontent');
  } else {
    $('#reg-email').addClass('hascontent');
  }
});

$('#reg-pass').on('input', function () {
  var passfield = $(this).val();
  if (passfield.length < 1) {
    $('#reg-pass').removeClass('hascontent');
  } else {
    $('#reg-pass').addClass('hascontent');
  }
});

$('#reg-pass-again').on('input', function () {
  var passAgainfield = $(this).val();
  if (passAgainfield.length < 1) {
    $('#reg-pass-again').removeClass('hascontent');
  } else {
    $('#reg-pass-again').addClass('hascontent');
  }
});

$('#reg-phone').on('input', function () {
  var phonefield = $(this).val();
  if (phonefield.length < 1) {
    $('#reg-phone').removeClass('hascontent');
  } else {
    $('#reg-phone').addClass('hascontent');
  }
});

function background() {
  var customBg = $('.dashboard-w2');
  var customBg2 = $('.dashboard-w1');
  var customBeforeBg = $('.dashboard-w2');

  customBg.css('background', function () {
    var bg = ('#' + $(this).data('bg'));
    return bg;
  });

  customBg2.css('background', function () {
    var bg = ('#' + $(this).data('bg'));
    return bg;
  });

  customBeforeBg.css('--before-bg-color', function () {
    var beforebg = ('#' + $(this).data('before'));
    return beforebg;
  });
};
