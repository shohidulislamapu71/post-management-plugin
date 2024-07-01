<div class="wrap">
        <h1 class="wp-heading-inline">Posts</h1>
        <div class="tablenav top">
            <div class="alignleft actions bulkactions">
                <form method="get">
                    <input type="hidden" name="page" value="post-managements">
                    <label for="category-selector" class="screen-reader-text">All Categories</label>
                    <select name="category-id" id="category-selector">
                        <option value="-1" <?php selected( '-1', $selected_category_id ); ?>>All Categories</option>
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?php echo esc_attr($category->term_id); ?>" <?php selected($category->term_id, $selected_category_id); ?>>
                                <?php echo esc_html($category->name); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <label for="author-selector" class="screen-reader-text">All Authors</label>
                    <select name="author-id" id="author-selector">
                        <option value="-1" <?php selected( '-1', $selected_author_id ); ?>>All Authors</option>
                        <?php foreach ($authors as $author) : ?>
                            <option value="<?php echo esc_attr($author->ID); ?>" <?php selected($author->ID, $selected_author_id); ?>>
                                <?php echo esc_html($author->display_name); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <input type="submit" class="button action" value="Apply">
                </form>
            </div>
        </div>
        <table class="wp-list-table widefat fixed striped table-view-list posts">
            <thead>
                <tr>
                    <th>Post Title</th>
                    <th>Author Name</th>
                    <th>Category Name</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if ($query->have_posts()) :
                    while ($query->have_posts()) : $query->the_post();
                        $author = get_the_author();
                        $post_categories = get_the_category();
                        $category_names = wp_list_pluck($post_categories, 'name');
                ?>
                <tr>
                    <td><?php the_title(); ?></td>
                    <td><?php echo esc_html($author); ?></td>
                    <td><?php echo esc_html(implode(', ', $category_names)); ?></td>
                </tr>
                <?php 
                    endwhile; 
                else : 
                ?>
                <tr>
                    <td colspan="3">No posts found.</td>
                </tr>
                <?php 
                endif; 
                wp_reset_postdata(); 
                ?>
            </tbody>
        </table>
    </div>
 