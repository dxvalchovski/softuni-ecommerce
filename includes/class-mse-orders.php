<?php
/**
 * Our Orders handler class.
 */

class MSE_Orders {
    public function __construct() {
        add_action( 'init', [ $this, 'orders_cpt_init'] );
    }

    public function orders_cpt_init() {
        $labels = array(
            'name'                  => __( 'Orders' ),
            'singular_name'         => __( 'Order' ),
            'menu_name'             => __( 'Orders' ),
            'name_admin_bar'        => __( 'Order' ),
            'add_new'               => __( 'Add New' ),
            'add_new_item'          => __( 'Add New Order' ),
            'new_item'              => __( 'New Order' ),
            'edit_item'             => __( 'Edit Order' ),
            'view_item'             => __( 'View Order' ),
            'all_items'             => __( 'All Orders' ),
            'search_items'          => __( 'Search Orders' ),
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'order' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array( 'title', 'editor', 'author', 'excerpt' ),
        );

        register_post_type( 'order', $args );
    }
}