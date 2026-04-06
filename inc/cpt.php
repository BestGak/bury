<?php

// ─── CPT: Projects ────────────────────────────────────────────────

add_action( 'init', 'bury_register_cpt_projects' );
function bury_register_cpt_projects() {
    register_post_type( 'projects', [
        'labels' => [
            'name'               => __( 'Projects', 'bury' ),
            'singular_name'      => __( 'Project', 'bury' ),
            'add_new'            => __( 'Add new', 'bury' ),
            'add_new_item'       => __( 'Add new project', 'bury' ),
            'edit_item'          => __( 'Edit project', 'bury' ),
            'new_item'           => __( 'New project', 'bury' ),
            'view_item'          => __( 'View project', 'bury' ),
            'search_items'       => __( 'Search projects', 'bury' ),
            'not_found'          => __( 'No projects found', 'bury' ),
            'not_found_in_trash' => __( 'No projects in trash', 'bury' ),
        ],
        'public'             => true,
        'publicly_queryable' => true,   
        'has_archive'        => false, 
        'show_in_rest'       => true,
        'menu_icon'          => 'dashicons-portfolio',
        'supports'           => [ 'title', 'editor', 'thumbnail', 'excerpt' ],
        'rewrite'            => [ 'slug' => 'projects', 'with_front' => false ],
    ] );
}

// ─── Taxonomy: Project Categories ────────────────────────────────

add_action( 'init', 'bury_register_taxonomy_project_category' );
function bury_register_taxonomy_project_category() {
    register_taxonomy( 'project_category', 'projects', [
        'labels' => [
            'name'              => __( 'Project categories', 'bury' ),
            'singular_name'     => __( 'Project category', 'bury' ),
            'add_new_item'      => __( 'Add new category', 'bury' ),
            'edit_item'         => __( 'Edit category', 'bury' ),
            'search_items'      => __( 'Search categories', 'bury' ),
        ],
        'public'            => false,   
        'publicly_queryable' => false,
        'show_in_rest'      => true,    
        'show_ui'           => true,    
        'show_admin_column' => true,    
        'hierarchical'      => true,
        'rewrite'           => false,   
    ] );
}
