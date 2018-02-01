(function ($, window, document) {
  'use strict';

  var page = {
    init: function () {
      page.ajax.init();
      var pathname = window.location.search;
      var order = pathname.split('=');
      var $linkOrder = $('.container').find('.sort-by').find('a');
      if (order[1] != null) {
        $linkOrder.removeClass('active').each(function () {
          if ($(this).attr('data-order') == order[1]) {
            $(this).addClass('active');
          }
        });
      }
      $('.btn').on('click', function () {
        var month = $('#select_month').val();
        var year = $('#select_year').val();
        if ((month === 'months') && (year === 'years')) {
          return;
        }

        location.href = (month != 'months') ? month : year;
      });
      page.scrollLoadAjax();
    },
    ajax: {
      init: function () {
        $('#select_year').on('change', function () {
          var selectedYear = $(this).find(":selected").text();
          page.ajax.getListMonths(selectedYear);
        });
      },
      getListMonths: function (data) {
        var ajax_url = ajax_params.ajax_url;
        var $content = document.getElementById('select_month');

        $.ajax({
          type: 'GET',
          url: ajax_url,
          data: {
            action: 'getListMonths',
            year: data
          },
          beforeSend: function () {
          },
          success: function (data) {
            $content.innerHTML = data;
            $content.sumo.unload();
            $('.archive').find('select').SumoSelect();
          },
          error: function () {
          },
          complete: function () {
          }
        });

        return false;
      }
    },
    scrollLoadAjax: function () {
      $('.load-more-btn').click(function () {
        var ajax_url = ajax_params.ajax_url;
        var data = {
          'action': 'load_posts_articles',
          'query': true_posts,
          'page': current_page
        };

        $.ajax({
          url: ajax_url,
          data: data,
          type: 'POST',
          success: function (response) {
            if (response) {
              var content = $(response);
              content.css({'opacity': 0});
              $('.content-holder').append(content);
              content.animate({'opacity': 1}, 1000);
              current_page++;

              window.loadMore = false;
              if (current_page >= +max_pages) $(".load-more-btn").css({'opacity': 0});
            } else {
              $('.load-more-btn').css({'opacity': 0});
            }
          }
        });
      })
    },
    load: function () {
    },
    resize: function () {
    },
    scroll: function () {
      var $content = $('.content-holder');

      var bottomScreen = $(window).scrollTop() + $(window).innerHeight();
      var bottomContent = $content.offset().top + $content.innerHeight();

      if (bottomScreen > (bottomContent) && !window.loadMore) {
        window.loadMore = true;
        $('.load-more-btn').trigger('click');
      }
    }
  };

  $(document).ready(page.init);
  $(window).on({
    'load': page.load,
    'resize': page.resize,
    'scroll': page.scroll
  });
})(jQuery, window, document);