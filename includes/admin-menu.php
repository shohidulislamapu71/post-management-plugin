<?php


class Post_Management_Admin_Menu{

    public function __construct () {
       add_action( 'admin_menu', [ $this, 'admin_menu' ] );
    }

    public function admin_menu () {
        add_menu_page( 'Post Management', 'Post Management', 'manage_options', 'post-managements', array($this,'post_management_menu'), 'dashicons-chart-pie', 2 );
    }

    public function post_management_menu () {

        // Check if a category ID is set and get its value
        if ( isset ( $_GET[ 'category-id' ] ) ) {
            $selected_category_id = intval( $_GET [ 'category-id' ] );
        } else {
            $selected_category_id = -1;
        }

        // Check if an author ID is set and get its value
        if ( isset ( $_GET [ 'author-id' ] ) ) {
            $selected_author_id = intval ( $_GET[ 'author-id' ] );
        } else {
            $selected_author_id = -1;
        }

        // Set up post query arguments
        $post_args = array (
            'posts_per_page'    => -1, // Get all posts
            'post_type'         => 'post',
        );

        // Modify query if a specific category is selected
        if ( $selected_category_id != -1 ) {
            $post_args [ 'category__in' ] = array ( $selected_category_id );
        }

        // Modify query if a specific author is selected
        if ( $selected_author_id != -1 ) {
            $post_args [ 'author' ] = $selected_author_id;
        }

        // Execute the query
        $query = new WP_Query( $post_args );

        // Get all authors
        $authors = get_users( array ( 'role__in' => array ( 'author', 'administrator', 'editor', 'contributor' ) ) );

        // Get all categories
        $categories = get_categories();

        // Call the post-menu-markup file
        require_once __DIR__ . '/templates/post-menu-markup.php';
    }
    
}
?>
