<?php
namespace Core\Controllers\Base;

use Core\Controllers\Base\Query;

final class Page
{
    public string   $ID;
    public string   $post_type;
    public bool     $content_enabled;


    private $wp_post;
    private $query;
    
    public array    $page_args;
    public array    $query_args;
    
    public function __construct(array $page_args = [], array $query_args = [])
    {
        global $wp_query;
        $this->ID                       =   hexdec(uniqid());
        $this->query_args               =   $wp_query->query;
        $this->page_args                =   $page_args;
        $this->post_type                =   "page";
        $this->content_enabled          =   true;
        
        // filters and actions
        add_filter( "posts_clauses_request", [$this, "skipMainQuery"], 10, 2 );
        add_filter( "body_class", [$this, "customBodyClass"] );
        $this->create();
    }

    public function skipMainQuery( $pieces, $wp_query ):?array
    {
        if(!empty(self::$endpoints)){
            foreach(self::$endpoints as $routeKey => $routeValue){
                if( isset( $wp_query->query[$routeKey] ) && $wp_query->is_main_query() ){
                    $pieces['where'] = ' AND ID = 0';
                }
            }
        }
        return $pieces;
    }

    public function create(): void
    {   
        global $wp_query;
        // TODO: Make it flexibile
        $this->wp_post = new \WP_Post((object) array_merge([
            "ID" => $this->ID,
            "post_type" => "page",
            "ancestors" => [],
            "comment_status" => 'closed',
            "comment_count" => 0,
            "filter" => 'raw',
            "guid" => home_url($this->query) . "/{$wp_query->query['current_page']}",
            "is_virtual" => true,
            "menu_order" => 0,
            "pinged" => '',
            "ping_status" => 'closed',
            "post_title" => ucfirst($wp_query->query['current_page']),
            "post_name" => sanitize_title($wp_query->query['current_page']),
            "post_content" => "",
            "post_excerpt" => '',
            "post_parent" => 0,
            "post_status" => 'publish',
            "post_date" => current_time('mysql'),
            "post_date_gmt" => current_time('mysql', 1),
            "modified" => current_time('mysql', 1),
            "modified_gmt" => current_time('mysql', 1),
            "post_password" => '',
            "post_content_filtered" => '',
            "post_author" => get_current_user_id(),
            "post_mime_type" => 'text/html',
            "to_ping" => '',
        ], $this->page_args));

        $this->query = new Query($this->ID, $this->wp_post);

        @status_header(200);
        wp_cache_add($this->ID, $this->wp_post, 'posts');
    }
    
    public function customBodyClass( array $classes ): array
    {
        if(get_query_var('is_ams_page')){
            $currentPage = get_query_var('current_page');
            // add virtual page name to body class
       	    $new_class = is_page() && get_the_ID() == $this->ID ? "page-{$currentPage}" : null;
            
            // if redirected to the login page
            // if(is_page() && get_the_ID() == $this->page_id && self::$endpoints[$currentPage]["need_login"] && !is_user_logged_in()){
            //     $new_class = "page-login";
            // }
           	
            if ( $new_class ) {
          		$classes[] = $new_class;
           	}
        }
    	return $classes;
    }
    
}