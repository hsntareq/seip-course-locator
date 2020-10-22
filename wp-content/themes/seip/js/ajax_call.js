var $ = jQuery;

$(function () {
  "use strict";

  // This does the ajax request
  $('#select_tranche button').click(function (e) {
    var button= $(this);
    button.attr("disabled", true);
    $('.loading').show();
    $('.tranche_name').text($(this).text());
    $(this).addClass('active').siblings('button').removeClass('active');
    var tranche = $(this).val();
    
    if (tranche == 1 || tranche == 3) {
      $('.uttoron-data').show();
    } else {
      $('.uttoron-data').hide();
    }
    
    $.ajax({
      method: 'POST',
      dataType: 'html',
      url: seip_ajax_obj.ajax_tms_api, // or seip_ajax_obj.ajaxurl if using on frontend
      data: {
        'tranche': tranche
      },
      success: function (data) {
        // This outputs the result of the ajax request
        $('.row-hover').html(data);
        $('.loading').hide();
        button.attr("disabled", false);
      },
      error: function (errorThrown) {
        console.log(errorThrown);
      }
    });
  })
  
})





$(window).on("load resize ", function () {
  var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
  $('.tbl-header').css({'padding-right': scrollWidth});
}).resize();
