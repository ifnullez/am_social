<?php
namespace Core\Controllers\Base;

class Query
{
    public function __construct(string $ID, $page)
    {
        global $wp_query, $wp;
        
        $wp_query->queried_object_id = $ID;
        $wp_query->current_post = $ID;
        $wp_query->posts = [$page];
        $wp_query->post = $page;
        $wp_query->found_posts = 1;
        $wp_query->is_page = true;
        $wp_query->is_singular = true;
        $wp_query->is_single = false;
        $wp_query->is_attachment = false;
        $wp_query->is_archive = false;
        $wp_query->is_category = false;
        $wp_query->is_tag = false;
        $wp_query->is_tax = false;
        $wp_query->is_author = false;
        $wp_query->is_date = false;
        $wp_query->is_year = false;
        $wp_query->is_month = false;
        $wp_query->is_day = false;
        $wp_query->is_time = false;
        $wp_query->is_search = false;
        $wp_query->is_feed = false;
        $wp_query->is_comment_feed = false;
        $wp_query->is_trackback = false;
        $wp_query->is_home = false;
        $wp_query->is_embed = false;
        $wp_query->is_404 = false;
        $wp_query->is_paged = false;
        $wp_query->is_admin = false;
        $wp_query->is_preview = false;
        $wp_query->is_robots = false;
        $wp_query->is_posts_page = false;
        $wp_query->is_post_type_archive = false;
        $wp_query->max_num_pages = 1;
        $wp_query->post_count = 1;
        $wp_query->max_num_comment_pages = 1;
        $wp_query->query_vars['error'] = '';
        unset($wp_query->query['error']);

        $GLOBALS['wp_query'] = $wp_query;
        $wp->query = [];
        $wp->register_globals();
    }

    public function __set($property, $value)
    {
        if(property_exists($this, $property)){
            $this->$property = $value;
        }
    }
}