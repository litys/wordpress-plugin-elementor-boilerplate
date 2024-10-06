<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Demo extends \Elementor\Widget_Base {

    public function get_name() {
        return 'posts_widget';
    }

    public function get_title() {
        return __( 'Posts List', 'litys-custom-blocks' );
    }

    public function get_icon() {
        return 'eicon-posts-grid';
    }

    public function get_categories() {
        return [ 'litys-custom-blocks' ];
    }

    public function get_custom_help_url() {
        return 'https://github.com/litys/wordpress-plugin-elementor-boilerplate';
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'litys-custom-blocks' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => __( 'Posts per page', 'litys-custom-blocks' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 20,
                'step' => 1,
                'default' => 5,
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $posts_per_page = $settings['posts_per_page'];

        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

        $args = [
            'post_type' => 'post',
            'posts_per_page' => $posts_per_page,
            'paged' => $paged,
        ];

        $query = new WP_Query( $args );

        if ( $query->have_posts() ) {
            echo '<ul class="posts-list">';
            while ( $query->have_posts() ) {
                $query->the_post();
                echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
            }
            echo '</ul>';

            $total_pages = $query->max_num_pages;
            if ( $total_pages > 1 ) {
                echo '<div class="pagination">';
                echo paginate_links( [
                    'total' => $total_pages,
                    'current' => $paged,
                ] );
                echo '</div>';
            }
        } else {
            echo __( 'No posts found', 'litys-custom-blocks' );
        }

        wp_reset_postdata();
    }
}
