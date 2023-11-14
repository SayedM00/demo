<?php if ( ! defined( 'FW' ) ) { die( 'Forbidden' ); }

$lamaro_cfg = lamaro_theme_config();

$options = array(
    
    'lamaro_customizer' => array(
        'title' => esc_html__('Lamaro settings', 'lamaro'),
        'position' => 1,
        'options' => array(

            'main_color' => array(
                'type' => 'color-picker',
                'value' => $lamaro_cfg['color_main'],
                'label' => esc_html__('Main Color', 'lamaro'),
            ),  
            'gray_color' => array(
                'type' => 'color-picker',
                'value' => $lamaro_cfg['color_gray'],
                'label' => esc_html__('Gray Color', 'lamaro'),
            ),
            'black_color' => array(
                'type' => 'color-picker',
                'value' => $lamaro_cfg['color_black'],
                'label' => esc_html__('Black Color', 'lamaro'),
            ),      
            'red_color' => array(
                'type' => 'color-picker',
                'value' => $lamaro_cfg['color_red'],
                'label' => esc_html__('Red Color', 'lamaro'),
            ),
            'white_color' => array(
                'type' => 'color-picker',
                'value' => $lamaro_cfg['color_white'],
                'label' => esc_html__('White Color', 'lamaro'),
            ),                          
            'nav_opacity' => array(
                'type'  => 'slider',
                'value' => 0,
                'properties' => array(
                    'min' => 0,
                    'max' => 1,
                    'step' => 0.05,
                ),
                'label' => esc_html__('Navbar Opacity (0 - 1)', 'lamaro'),
            ), 
            'nav_opacity_scroll' => array(
                'type'  => 'slider',
                'value' => 0.95,
                'properties' => array(
                    'min' => 0,
                    'max' => 1,
                    'step' => 0.05,
                ),
                'label' => esc_html__('Navbar Sticked Opacity (0 - 1)', 'lamaro'),
            ),
            'logo_height' => array(
                'type'  => 'slider',
                'value' => 140,
                'properties' => array(

                    'min' => 20,
                    'max' => 160,
                    'step' => 1,

                ),
                'label' => esc_html__('Logo Max Height, px', 'lamaro'),
            ),                            
        ),
    ),
);


