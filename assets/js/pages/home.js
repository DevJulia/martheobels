function home()
{
  var $frame = $('#basic');
  var $wrap = $frame.parent();

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
    dynamicHandle: 1,
    clickBar: 1,
    keyboardNavBy: 'pages',
  };

  var sly = new Sly($frame, options).init();

  sly.on('moveEnd', function (e) {
    console.log(Math.round(sly.pos.cur * 100 / sly.pos.end));
  });

  $wrap.find('.toStart').on('click', function() {
    var item = $(this).data('item');
    // Animate a particular item to the start of the frame.
    // If no item is provided, the whole content will be animated.
    $frame.sly('toStart', item);
  });

  
  $(window).resize(function () {
    sly.reload();
  });
}

export { home };