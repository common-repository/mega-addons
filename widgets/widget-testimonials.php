<?php 
namespace Mega_Addons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Title
class Mega_Addons_Widget_Testimonials extends Widget_Base {
 
   public function get_name() {
      return 'testimonials';
   }
 
   public function get_title() {
      return esc_html__( 'Testimonials', 'mega-addons' );
   }
 
   public function get_icon() { 
        return 'eicon-testimonial';
   }
 
   public function get_categories() {
      return [ 'mega_addons' ];
   }

   protected function _register_controls() {

      $this->start_controls_section(
         'testimonials_section',
         [
            'label' => esc_html__( 'Testimonials', 'mega-addons' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $testimonial = new \Elementor\Repeater();

      $testimonial->add_control(
         'image',
         [
            'label' => __( 'Choose Photo', 'mega-addons' ),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
               'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
         ]
      );
      
      $testimonial->add_control(
         'name',
         [
            'label' => __( 'Name', 'mega-addons' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __( 'John Doe', 'mega-addons' ),
         ]
      );

      $testimonial->add_control(
         'designation',
         [
            'label' => __( 'Designation', 'mega-addons' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __( 'CEO of Uber', 'mega-addons' ),
         ]
      );


      $testimonial->add_control(
         'testimonial',
         [
            'label' => __( 'Testimonial', 'mega-addons' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => __( 'The drivers are always super sweet and smiling. Plus I get bonuses each time I use this company’s services which is so cool…', 'mega-addons' ),
         ]
      );

      $this->add_control(
         'testimonial_list',
         [
            'label' => __( 'Testimonial List', 'mega-addons' ),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $testimonial->get_controls(),
            'title_field' => '{{ name }}',
         ]
      );
      
      $this->end_controls_section();

   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display(); ?>

      <div class="container">
         <div class="mega-addons-testimonials">
         <?php foreach ( $settings['testimonial_list'] as $index => $testimonial ):
         $testimonialText = $this->get_repeater_setting_key( 'testimonial','testimonial_list',$index);
         $name = $this->get_repeater_setting_key( 'name','testimonial_list',$index);         
         $designation = $this->get_repeater_setting_key( 'designation','testimonial_list',$index);
         $this->add_inline_editing_attributes( $testimonialText, 'basic' );
         $this->add_inline_editing_attributes( $name, 'basic' );         
         $this->add_inline_editing_attributes( $designation, 'basic' );
         ?>
            <div class="mega-addons-testimonial">
               <div class="mega-addons-testimonial-content">
                  <?php echo wp_get_attachment_image( $testimonial['image']['id'], 'mega-addons-100x100' ); ?>
                  <i class="fa fa-quote-left fa-3x"></i>
                  <p <?php echo $this->get_render_attribute_string( $testimonialText ); ?>><?php echo esc_html($testimonial['testimonial']); ?></p>                          
                  <h5 <?php echo $this->get_render_attribute_string( $name ); ?>><?php echo esc_html($testimonial['name']); ?></h5>
                  <span <?php echo $this->get_render_attribute_string( $designation ); ?>>- <?php echo esc_html($testimonial['designation']); ?></span>
               </div>      
            </div>
            
         <?php endforeach ?>
         </div>
      </div>

      <?php
   }
}