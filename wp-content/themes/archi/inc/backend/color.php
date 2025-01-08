<?php 
//Custom Style Frontend
if(!function_exists('archi_color_scheme')){
    function archi_color_scheme(){
        $color_scheme = '';

        //Main Color
        if( !empty( archi_get_option('main_color') ) && archi_get_option('main_color') != '#FAB702' ){
            $color_scheme = 
            '
            :root {
                --archi-color-primary: '.archi_get_option('main_color').';
            }
            #jpreBar{ background: '.archi_get_option('main_color').'; }
            ';
        }

        if(! empty($color_scheme)){
            echo '<style type="text/css">'.$color_scheme.'</style>';
        }
    }
}
add_action('wp_head', 'archi_color_scheme');