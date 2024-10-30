<?php 
namespace Mega_Addons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// blog
class Mega_Addons_Widget_Blog extends Widget_Base {
 
   public function get_name() {
      return 'blog';
   }
 
   public function get_title() {
      return esc_html__( 'Latest Blog', 'mega-addons' );
   }
 
   public function get_icon() { 
        return 'eicon-posts-carousel';
   }
 
   public function get_categories() {
      return [ 'mega_addons' ];
   }
   protected function _register_controls() {
      
      $this->start_controls_section(
         'post_section',
         [
            'label' => esc_html__( 'Post', 'mega-addons' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

        $this->add_control(
         'style',
         [
            'label' => __( 'Style', 'mega-addons' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'style_1',
            'options' => [
               'style_1'  => __( 'Style 1', 'mega-addons' ),
               'style_2' => __( 'Style 2', 'mega-addons' ),
               'style_3' => __( 'Style 3', 'mega-addons' ),
               'none' => __( 'None', 'mega-addons' )
            ],
         ]
      );

      $this->add_control(
         'posts_per_page',
         [
            'label' => __( 'Posts per page', 'mega-addons' ),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'min' => 1,
            'max' => 100,
            'step' => 1,
            'default' => 3,
         ]
      );

      $this->add_control(
         'order',
         [
            'label' => __( 'Order', 'mega-addons' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'DESC',
            'options' => [
               'ASC'  => __( 'Ascending', 'mega-addons' ),
               'DESC' => __( 'Descending', 'mega-addons' )
            ],
         ]
      );
      
      $this->end_controls_section();
   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display(); ?>

      <div class="container">
         <div class="row justify-content-center">
               <?php
               $Post = new \WP_Query( array( 
                  'post_type' => 'post',
                  'posts_per_page' => $settings['posts_per_page'],
                  'ignore_sticky_posts' => true,
                  'order' => $settings['order'],
               ));
               /* Start the Loop */
               while ( $Post->have_posts() ) : $Post->the_post();
               ?>

               <!-- Post -->
               <?php if ( 'style_1' == $settings['style'] ): ?>
               <div class="col-lg-4 col-sm-6">
                  <div class="mega-addons-post">
                     <div class="mega-addons-post-img">
                        <?php if (has_post_thumbnail()) { ?>
                           <a href="<?php the_permalink() ?>">
                              <img src="<?php echo get_the_post_thumbnail_url( get_the_ID(),'mega-addons-360-200'); ?>" alt="<?php the_title() ?>">
                           </a>
                        <?php } ?>
                     </div>
                     
                     <div class="mega-addons-post-content">
                        <span>
                           <?php the_time( 'F j, Y' ) ?>
                        </span>
                        <a href="<?php the_permalink() ?>"><h5><?php echo wp_trim_words( get_the_title(), 8, '...' );?></h5></a>
                        <ul class="list-inline">
                           <li class="list-inline-item">
                              <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?><?php the_author(); ?></a>
                           </li>
                        </ul>       
                     </div>
                  </div>
               </div>
               <?php elseif( 'style_2' == $settings['style'] ): ?>
                  
               <?php endif ?>
               <?php 
               endwhile; 
            wp_reset_postdata();
            ?>
         </div>
      </div>

      <?php
   }
 
}