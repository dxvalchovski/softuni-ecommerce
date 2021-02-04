<?php
/**
 * Our products handler class.
 */

class MSE_Products {
    public function __construct() {
        add_action( 'init', [ $this, 'products_cpt_init'] );
        add_action( 'add_meta_boxes', [ $this, 'products_price_box' ] );
        add_action( 'save_post' , [ $this, 'products_save' ], 3, 10 );
    }

    public function products_save( $post_id, $post, $update ) {
        update_post_meta( $post_id, 'price', intval( $_POST['mse_price'] ) );
    }

    public function products_price_box() {
        $screens = [ 'product' ];
        foreach ( $screens as $screen ) {
            add_meta_box(
                'mse_price_id',
                'Price',
                [ $this, 'products_price_box_html' ],
                $screen,
                'side'
            );
        }
    }

    public function products_price_box_html( $post ) {
        $product_price = get_post_meta( $post->ID, 'price', true );
        ?>
        <label for="mse_price">Product Price</label>
        <input name="mse_price" id="mse_price" class="postbox" value="<?php echo intval( $product_price ); ?>">
        <?php
    }

    public function products_cpt_init() {
        $labels = array(
            'name'                  => __( 'Products' ),
            'singular_name'         => __( 'Product' ),
            'menu_name'             => __( 'Products' ),
            'name_admin_bar'        => __( 'Product' ),
            'add_new'               => __( 'Add New' ),
            'add_new_item'          => __( 'Add New Product' ),
            'new_item'              => __( 'New Product' ),
            'edit_item'             => __( 'Edit Product' ),
            'view_item'             => __( 'View Product' ),
            'all_items'             => __( 'All Products' ),
            'search_items'          => __( 'Search Products' ),
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'product' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' ),
        );

        register_post_type( 'product', $args );
    }
}