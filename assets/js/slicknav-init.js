jQuery(function ($) {
    if($('#unc-menu').length) {
        $('#unc-slick').slicknav({
            label: 'Menu',
            duration: 500,
            prependTo: '#unc-menu',
            init: function (autoopen) {
            }
        });

        $(function (autoopen) {
            jQuery('#unc-slick').slicknav('close');
        });
    }
});