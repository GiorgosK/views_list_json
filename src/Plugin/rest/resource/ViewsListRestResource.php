<?php

namespace Drupal\views_list_json\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;

/**
 * Provides a Views List Rest Resource
 *
 * @RestResource(
 *   id = "views_list_json",
 *   label = @Translation("Views List"),
 *   uri_paths = {
 *     "canonical" = "views_list_json/views_list"
 *   }
 * )
 */
class ViewsListRestResource extends ResourceBase {


    /**
     * Responds to entity GET requests.
     * @return \Drupal\rest\ResourceResponse
     */
    public function get() {

        $entity_ids = \Drupal::service('entity.query')
            ->get('view')
            ->condition('status', TRUE)
            ->execute();

        $views = [];        
        foreach (\Drupal::entityManager()
            ->getStorage('view')
            ->loadMultiple($entity_ids) as $view) {

            $displays = [];
            // Check each display to see if it meets the criteria and is enabled.
            foreach ($view->get('display') as $id => $display) {
        
                // If the key doesn't exist, enabled is assumed.
                $enabled = !empty($display['display_options']['enabled']) || !array_key_exists('enabled', $display['display_options']);
                if ($enabled ) {
                    $displays[] = [
                        'id' => $display['id'],
                    ];
                }
            }
            $views[] = [
                'view_id' => $view->id(),
                'displays' => $displays,
            ];
        }

        $response = new ResourceResponse($views);
        return $response;
    }
}