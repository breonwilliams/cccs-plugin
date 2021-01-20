<?php


function clean_shortcodes($content) {
    $array = array (
        '<p>[' => '[',
        ']</p>' => ']',
        '<p><span>[' => '[',
        ']</span></p>' => ']',
        ']<br />' => ']'
    );

    $content = strtr($content, $array);
    return $content;
}
add_filter('the_content', 'clean_shortcodes');
