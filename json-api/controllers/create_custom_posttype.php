<?php
class JSON_API_CustomPostType_Controller {
    protected function create_post() {
        global $json_api;
        if (!$json_api->query->nonce) {
          $json_api->error("You must include a 'nonce' value to create posts. Use the `get_nonce` Core API method.");
        }
        $nonce_id = $json_api->get_nonce_id('posts', 'create_post');
        if (!wp_verify_nonce($json_api->query->nonce, $nonce_id)) {
          $json_api->error("Your 'nonce' value was incorrect. Use the 'get_nonce' API method.");
        }
        nocache_headers();
        $post = new JSON_API_Post();
        $id = $post->create($_REQUEST);
        if (empty($id)) {
          $json_api->error("Could not create post.");
        }
        return array(
          'post' => $post
        );
    }

}
?>
