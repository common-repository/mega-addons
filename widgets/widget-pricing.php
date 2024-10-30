<?php 
namespace Mega_Addons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Pricing
class Mega_Addons_Widget_Pricing extends Widget_Base {
 
   public function get_name() {
      return 'pricing';
   }
 
   public function get_title() {
      return esc_html__( 'Pricing', 'mega-addons' );
   }
 
   public function get_icon() { 
        return 'eicon-price-table';
   }
 
   public function get_categories() {
      return [ 'mega_addons' ];
   }

   protected function _register_controls() {

      $this->start_controls_section(
         'pricing_section',
         [
            'label' => esc_html__( 'Pricing', 'mega-addons' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $this->add_control(
         'style',
         [
            'label' => __( 'Icon Box Style', 'mega-addons' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'style_1',
            'options' => [
               'style_1'  => __( 'Card', 'mega-addons' ),
               'style_2' => __( 'Tabs', 'mega-addons' ),
               'none' => __( 'None', 'mega-addons' )
            ],
         ]
      );

      $this->add_control(
         'title',
         [
            'label' => __( 'title', 'mega-addons' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Standard Plan',
            'condition' => ['style' => 'style_1']
         ]
      );

      $this->add_control(
         'icon',
         [
            'label' => __( 'icon', 'mega-addons' ),
            'type' => \Elementor\Controls_Manager::ICON,
            'label_block' => true,
            'default' => 'fa fa-shield',
            'condition' => ['style' => 'style_1']
         ]
      );

      $this->add_control(
         'price',
         [
            'label' => __( 'Price', 'mega-addons' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '70',
            'condition' => ['style' => 'style_1']
         ]
      );
      
      $this->add_control(
         'currency',
         [
            'label' => __( 'Currency', 'mega-addons' ),
            'type' => \Elementor\Controls_Manager::ICON,
            'default' => 'fa fa-dollar',
            'include' => [
               'fa fa-bitcoin',
               'fa fa-btc',
               'fa fa-cny',
               'fa fa-dollar',
               'fa fa-eur',
               'fa fa-euro',
               'fa fa-gbp',
               'fa fa-ils',
               'fa fa-inr',
               'fa fa-jpy',
               'fa fa-krw',
               'fa fa-money',
               'fa fa-rmb',
               'fa fa-rouble',
               'fa fa-rub',
               'fa fa-ruble',
               'fa fa-rupee',
               'fa fa-shekel',
               'fa fa-sheqel',
               'fa fa-try',
               'fa fa-turkish-lira',
               'fa fa-usd',
               'fa fa-won',
               'fa fa-yen',
            ],
         ]
      );
      
      $this->add_control(
         'package',
         [
            'label' => __( 'Package', 'mega-addons' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'Yealry',
            'options' => [
               'Daily'  => __( 'Daily', 'mega-addons' ),
               'Weekly'  => __( 'Weekly', 'mega-addons' ),
               'Monthly' => __( 'Monthly', 'mega-addons' ),
               'Yealry' => __( 'Yealry', 'mega-addons' ),
               'none' => __( 'None', 'mega-addons' )
            ],
         ]
      );

      $feature = new \Elementor\Repeater();

      $feature->add_control(
         'feature',
         [
            'label' => __( 'Feature', 'mega-addons' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => __( '10 Free Domain Names', 'mega-addons' )
         ]
      );

      $this->add_control(
         'feature_list',
         [
            'label' => __( 'Feature List', 'mega-addons' ),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $feature->get_controls(),
            'default' => [
               [
                  'feature' => __( '5GB Storage Space', 'mega-addons' )
               ],
               [
                  'feature' => __( '20GB Monthly Bandwidth', 'mega-addons' )
               ],
               [
                  'feature' => __( 'My SQL Databases', 'mega-addons' )
               ],
               [
                  'feature' => __( '100 Email Account', 'mega-addons' )
               ],
               [
                  'feature' => __( '10 Free Domain Names', 'mega-addons' )
               ]
            ],
            'title_field' => '{{{ feature }}}',
            'condition' => ['style' => 'style_1']
         ]
      );

      $this->add_control(
         'btn_text',
         [
            'label' => __( 'button text', 'mega-addons' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Select Plan',
            'condition' => ['style' => 'style_1']
         ]
      );

      $this->add_control(
         'btn_url',
         [
            'label' => __( 'button URL', 'mega-addons' ),
            'type' => \Elementor\Controls_Manager::URL,
            'placeholder' => __( 'https://example.com', 'mega-addons' ),
            'show_external' => true,
            'default' => [
               'url' => '#',
               'is_external' => true,
               'nofollow' => true,
            ],
            'condition' => ['style' => 'style_1']
         ]
      );

      $this->add_control(
         'recommended',
         [
            'label' => __( 'Recommended', 'plugin-domain' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __( 'On', 'mega-addons' ),
            'label_off' => __( 'Off', 'mega-addons' ),
            'return_value' => 'on',
            'default' => 'off',
         ]
      );

      $this->end_controls_section();
   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display();
      
      //Inline Editing
      $this->add_inline_editing_attributes( 'title', 'basic' );
      $this->add_inline_editing_attributes( 'price', 'basic' );
      $this->add_inline_editing_attributes( 'btn_text', 'basic' );
      $this->add_inline_editing_attributes( 'btn_url', 'basic' );

      $target = $settings['website_link']['is_external'] ? ' target="_blank"' : '';
      $nofollow = $settings['website_link']['nofollow'] ? ' rel="nofollow"' : '';

      ?>

      <div class="mega-addons-pricing-table <?php if ( 'on' == $settings['recommended'] ){ echo"recommended"; }?>">
         <h6 class="type elementor-inline-editing" <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo esc_html( $settings['title'] ); ?></h6>
         <h1 class="mega-addons-price elementor-inline-editing" <?php echo $this->get_render_attribute_string( 'price' ); ?>>
            <span class="mega-addons-currency <?php echo esc_attr($settings['currency']) ?>"></span>
            <?php echo esc_html( $settings['price'] ); ?>
         </h1>
         <span><?php echo esc_html( $settings['package'] ); ?></span>
         <ul>
            <?php 
               foreach (  $settings['feature_list'] as $index => $feature ) { 
               $feature_inline = $this->get_repeater_setting_key( 'feature','feature_list',$index);
               $this->add_inline_editing_attributes( $feature_inline, 'basic' );
            ?>
               <li <?php echo $this->get_render_attribute_string( $feature_inline ); ?>><?php echo $feature['feature'] ?></li>
            <?php 
            } ?>
         </ul>
         <a class="elementor-inline-editing mega-addons-buy-button" href="<?php echo esc_attr( $settings['btn_url'] ) ?>" <?php echo $this->get_render_attribute_string( 'btn_text' ); ?><?php echo esc_attr( $target ) . esc_attr( $nofollow ) ?>><?php echo esc_html( $settings['btn_text'] ) ?></a>
      </div>

      <?php
   }
 
}