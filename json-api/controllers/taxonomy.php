<?php
class JSON_API_Taxonomy_Controller {

    public function get_taxonomy() {
        $terms = $this->get_current_taxonomy();
        return array(
            'count' => count( $terms ),
            'terms' => $terms
        );
    }
    
    public function get_current_taxonomy() {
        global $json_api;
        extract($json_api->query->get(array( 'id', 'taxonomy' )));
        if (!$taxonomy && !$id) {
            $json_api->error("Not found.");
        }

        $wp_terms = get_the_terms( $id, $taxonomy);
        $terms = array();
        foreach ( $wp_terms as $wp_term ) {
            $terms[] = new JSON_API_Term( $wp_term );
        }
        return $terms;
    }

    public function get_taxonomies_index() {
        $terms = $this->get_terms();
        return array(
            'count' => count( $terms ),
            'terms' => $terms
        );
    }

    public function get_terms() {
        global $json_api;
        $taxonomy = $this->get_current_taxonomies();
        if (!$taxonomy) {
            $json_api->error("Not found.");
        }

        $wp_terms = get_terms( $taxonomy );
        $terms = array();
        foreach ( $wp_terms as $wp_term ) {
            if ( $wp_term->term_id == 1 && $wp_term->slug == 'uncategorized' ) {
                continue;
            }
            $terms[] = new JSON_API_Term( $wp_term );
        }
        return $terms;
    }

    protected function get_current_taxonomies() {
        global $json_api;
        $taxonomy  = $json_api->query->get('taxonomy');
        if ( $taxonomy ) {
            return $taxonomy;
        } else {
            $json_api->error("Include 'taxonomy' var in your request.");
        }
        return null;
    }
    
}

?>
