<?php 
namespace Mega_Addons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Button
class Mega_Addons_Widget_Button extends Widget_Base {
 
   public function get_name() {
      return 'button';
   }
 
   public function get_title() {
      return esc_html__( 'Button', 'mega-addons' );
   }
 
   public function get_icon() { 
        return 'eicon-button';
   }
 
   public function get_categories() {
      return [ 'mega_addons' ];
   }

   protected function _register_controls() {

      $this->start_controls_section(
         'button_section',
         [
            'label' => esc_html__( 'Button', 'mega-addons' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $this->add_control(
         'button_style',
         [
            'label' => __( 'Button Style', 'mega-addons' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'style_1',
            'options' => [
               'style_1'  => __( 'Style 1', 'mega-addons' ),
               'style_2' => __( 'Style 2', 'mega-addons' ),
               'none' => __( 'None', 'mega-addons' ),
            ],
         ]
      );

      $this->add_control(
         'button_text', [
            'label' => __( 'Button Text', 'mega-addons' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __( 'Raed More', 'mega-addons' )
         ]
      );

      $this->add_control(
         'button_icon',
         [
            'label' => __( 'Icon', 'mega-addons' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __( 'Yes', 'mega-addons' ),
            'label_off' => __( 'No', 'mega-addons' ),
            'return_value' => 'yes',
            'default' => 'no',
            'condition'  => [ 'button_style' => 'style_1' ]
         ]
      );

      $this->add_control(
         'icon',
         [
            'label' => __( 'Choose Icon', 'mega-addons' ),
            'type' => \Elementor\Controls_Manager::ICON,
            'default' => 'fa fa-play',
            'condition' => ['button_icon' => 'yes']
         ]
      );

      $this->add_control(
         'button_icon_text',
         [
            'label' => __( 'Icon Text', 'mega-addons' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __( 'Show', 'mega-addons' ),
            'label_off' => __( 'Hide', 'mega-addons' ),
            'return_value' => 'yes',
            'default' => 'no',
            'condition'  => [ 'button_style' => 'style_2' ]
         ]
      );

      $this->add_control(
         'button_url', [
            'label' => __( 'Button URL', 'mega-addons' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '#',
         ]
      );      

      $this->add_control(
         'popup',
         [
            'label' => __( 'Popup Video', 'mega-addons' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __( 'Yes', 'mega-addons' ),
            'label_off' => __( 'No', 'mega-addons' ),
            'return_value' => 'yes',
            'default' => 'no'
         ]
      );

      $this->add_control(
         'align',
         [
            'label' => __( 'Alignment', 'mega-addons' ),
            'type' => \Elementor\Controls_Manager::CHOOSE,
            'options' => [
               'left' => [
                  'title' => __( 'Left', 'mega-addons' ),
                  'icon' => 'fa fa-align-left',
               ],
               'center' => [
                  'title' => __( 'Center', 'mega-addons' ),
                  'icon' => 'fa fa-align-center',
               ],
               'right' => [
                  'title' => __( 'Right', 'mega-addons' ),
                  'icon' => 'fa fa-align-right',
               ],
            ],
            'default' => 'left',
            'toggle' => true
         ]
      );

       $this->add_control(
         'drop_shadow',
         [
            'label' => __( 'Drop Shadow', 'mega-addons' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __( 'Show', 'mega-addons' ),
            'label_off' => __( 'Hide', 'mega-addons' ),
            'return_value' => 'yes',
            'default' => 'yes',
            'condition'  => [ 'button_style' => 'style_1' ]
         ]
      );

      $this->add_control(
         'bordered',
         [
            'label' => __( 'Bordered', 'mega-addons' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __( 'Yes', 'mega-addons' ),
            'label_off' => __( 'No', 'mega-addons' ),
            'return_value' => 'yes',
            'default' => 'no',
            'condition'  => [ 'button_style' => 'style_1' ]
         ]
      );

      $this->add_control(
         'button_radius',
         [
            'label' => __( 'Button Radius', 'mega-addons' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%' ],
            'range' => [
               'px' => [
                  'min' => 0,
                  'max' => 50,
                  'step' => 1,
               ]
            ],
            'default' => [
               'unit' => 'px',
               'size' => 0,
            ],
            'condition'  => [ 'button_style' => 'style_1' ]
         ]
      );

      $this->end_controls_section();

   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display();

      //Inline Editing
      $this->add_inline_editing_attributes( 'button_text', 'basic' );
      ?>

      <div style="text-align: <?php echo esc_attr($settings['align']) ?>">
         <?php if ('style_1' == $settings['button_style']): ?>

         <a class="mega-addons-btn <?php if( 'yes' == $settings['bordered'] ){ echo'bordered'; } ?> elementor-inline-editing <?php if('yes' == $settings['drop_shadow']){ echo'shadow'; } ?> <?php if( 'yes' == $settings['popup'] ){ echo'mega-addons-popup-url'; } ?>" style="border-radius: <?php echo esc_attr($settings['button_radius']['size']) ?>px;" <?php echo $this->get_render_attribute_string( 'button_text' ); ?> href="<?php echo esc_url( $settings['button_url'] ); ?>"><?php if ( 'yes' == $settings['button_icon'] ) { echo '<i class="'.$settings['icon'].'"></i>'; } ?><?php echo esc_html( $settings['button_text'] ); ?></a>

         <?php elseif('style_2' == $settings['button_style']): ?>
         
         <a href="<?php echo esc_url( $settings['button_url'] ); ?>" class="mega-addons-play-btn <?php if( 'yes' == $settings['popup'] ){ echo'mega-addons-popup-url'; } ?>">
            <span>
               <?php if ( 'yes' == $settings['button_icon_text'] ): ?>
                  <span class="mega-addons-play-btn-txt elementor-inline-editing" <?php echo $this->get_render_attribute_string( 'button_text' ); ?>><?php echo esc_html( $settings['button_text'] ); ?></span>
               <?php endif ?>               
               <span class="mega-addons-play-btn-icon"><i class="fa fa-play"></i></span>
            </span>
         </a>
            
         <?php endif ?>
      </div>

      <?php
   }
 
}