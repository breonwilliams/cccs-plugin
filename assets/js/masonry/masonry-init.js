/**
 * Created by breon on 12/5/16.
 */
jQuery(function($) {
    // init Masonry
    var $grid = $('.mgrid').masonry({
        itemSelector: '.mgrid-item'
    });
// layout Masonry after each image loads
    $grid.imagesLoaded().progress( function() {
        $grid.masonry('layout');
    });
});

