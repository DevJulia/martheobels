function home()
{
  var step = $(window).width() * 0.3;
  console.log(step);

  $(window).resize(function() {
    $('.main-home').css('transform', 'matrix(1, 0, 0, 1, 0, 0)');
    step = $(window).width() * 0.3;
    $('.progress').css('width', '0');
  });

  var wheeldelta = {
    x: 0,
    y: 0
  };
  
  var wheeling;
  $('.main-home').on('wheel', function (e) {
    if (!wheeling) {
      console.log('start wheeling!');
      var transMatrix = $(this).css('transform');
      var direction = 1;
      var position = 0;

      console.log($('.main-home').width());
  
      if (transMatrix !== 'none') {
        position = transMatrix.split('(')[1];
        position = position.split(')')[0];
        position = position.split(',');
        position = parseFloat(position[4]);
      }

      console.log('pos :' + position);
  
      if(e.originalEvent.deltaY < 0){
        //Mouse wheel up
        var direction = 1;
      }
      else {
        //Mouse wheel down
        var direction = -1;
      }
  
      if (position + direction*step <= 0 && position + direction*step >= (- $('.main-home').width() - 0.8*$(window).width())) {
        let percentage = -100*(position + direction*step)/$(window).width();
        console.log('%:' + percentage );

        $('.progress').css('width', percentage + '%');

        $(this).animate({
          'opacity': step
        }, {
          step: function (now) {
            if (transMatrix !== 'none') {
              $(this).css('transform', 'translate3d('+ (position + direction*now) + 'px, 0px, 0px)');
            } else {
              $(this).css('transform', 'translate3d(-'+ now + 'px, 0px, 0px)');
            }
          },
          duration: 600,
          easing: 'swing',
          queue: false,
          complete: function () {
            if (transMatrix !== 'none') {
              $(this).css('transform', 'matrix(1, 0, 0, 1,'+ (position + direction*step) +', 0)');
            } else {
              $(this).css('transform', 'matrix(1, 0, 0, 1, -'+ step +', 0)');
            }
          }
        }, 'swing');
      }
    }
  
    clearTimeout(wheeling);
    wheeling = setTimeout(function() {
      console.log('stop wheeling!');
      wheeling = undefined;
  
      // reset wheeldelta
      wheeldelta.x = 0;
      wheeldelta.y = 0;
    }, 250);
  
    wheeldelta.x += e.originalEvent.deltaX;
    wheeldelta.y += e.originalEvent.deltaY;
    // console.log(wheeldelta);
  });
}

export { home };