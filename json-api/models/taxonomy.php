<?php
class JSON_API_Term {

  var $id;          // Integer
  var $slug;        // String
  var $title;       // String
  var $description; // String

  function JSON_API_Term($term = null) {
    if ($term) {
      $this->import_wp_object($term);
    }
  }

  function import_wp_object($term) {
    $this->id = (int) $term->term_id;
    $this->slug = $term->slug;
    $this->title = $term->name;
    $this->description = $term->description;
    $this->post_count = (int) $term->count;
  }

}
?>
