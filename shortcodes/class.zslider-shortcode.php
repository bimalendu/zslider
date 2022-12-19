<?php 

if( ! class_exists('ZSlider_Shortcode')){
    class ZSlider_Shortcode{
        public function __construct(){
            add_shortcode( 'zslider', array( $this, 'add_shortcode' ) );
        }

        public function add_shortcode( $atts = array(), $content = null, $tag = '' ){

            $atts = array_change_key_case( (array) $atts, CASE_LOWER );

            extract( shortcode_atts(
                array(
                    'id' => '',
                    'orderby' => 'date'
                ),
                $atts,
                $tag
            ));

            if( !empty( $id ) ){
                $id = array_map( 'absint', explode( ',', $id ) );
            }
            
            ob_start();
            require( zSLIDER_PATH . 'views/zslider_shortcode.php' );
            wp_enqueue_script( 'zslider-main-jq' );
            wp_enqueue_style( 'zslider-main-css' );
            wp_enqueue_style( 'zslider-style-css' );
            zslider_options();
            return ob_get_clean();
        }
    }
}
