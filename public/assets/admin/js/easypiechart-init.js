$(function() {
  $('.number').easyPieChart({
    barColor: '#0499dd',
    scaleColor: '#0499dd',
    lineWidth: 3,
    easing: 'easeOutBounce',
    onStep: function(from, to, percent) {
      $(this.el).find('.percent').text(Math.round(percent));
    }
  });
  var chart = window.chart = $('.number').data('easyPieChart');
  $('.js_update').on('click', function() {
    chart.update(Math.random()*200-100);
  });
});