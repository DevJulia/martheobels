function home()
{
  var $frame = $('#basic');
  var $wrap = $frame.parent();
  var sly;

  let options = {
    horizontal: 1,
    itemNav: 'basic',
    slidee: '.slidee',
    smart: 1,
    // mouseDragging: 1,
    // touchDragging: 1,
    releaseSwing: 1,
    startAt: 0,
    scrollBar: $wrap.find('.scrollbar'),
    scrollBy: 1,
    speed: 500,
    elasticBounds: 1,
    dragHandle: 1,
    dynamicHandle: 0,
    clickBar: 1,
    keyboardNavBy: 'items',
  };

  if ($(window).width() >= 700) {
    sly = new Sly($frame, options).init();
  }

  var nav = [];
  $('.navigation button').each(function() {
    nav.push($(this).attr('data-item'));
  });

  // Update progress bar
  sly.on('moveEnd', function() {updateNav(sly,nav)});

  $wrap.find('.toStart').on('click', function() {
    var item = $(this).data('item');
    // Animate a particular item to the start of the frame.
    // If no item is provided, the whole content will be animated.
    $frame.sly('toStart', item);
  });

  
  $(window).resize(function () {
    if ($(window).width() < 700) {
      sly.destroy();
    } else {
      if (sly.initialized) {
        sly.reload();
      } else {
        sly = new Sly($frame, options).init();
        sly.on('moveEnd', function() {updateNav(sly,nav)});
      }
    }
  });
}

function updateNav(sly, nav) {
  let percentage = Math.round(sly.pos.cur * 100 / sly.pos.end);
  $('.scrollbar .progress').css('width', percentage + '%');

  let currentIndex = Math.max.apply(null, nav.filter(function(v){
    return v <= sly.rel.firstItem
  }))

  nav.forEach(item => {
    if (item <= currentIndex) {
      $('.navigation button[data-item="'+ item +'"]').addClass('active');
    } else {
      $('.navigation button[data-item="'+ item +'"]').removeClass('active');
    }
  });
}

export { home };