<?php

namespace Drupal\drupal_test\Controller;

use Drupal\Core\Url;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class RepresentNodeController to display node information.
 */
class RepresentNodeController extends ControllerBase {

  /**
   * Function to display given node info in JSON representation.
   *
   * @param string $siteapikey
   *   System variable siteapikey.
   * @param int $nid
   *   Given node ID.
   *
   * @return mixed
   *   Response object.
   */
  public function displayNodeInfo(string $siteapikey, int $nid) {
    // Creating access denied response if validation fails.
    $response = new RedirectResponse((new Url('system.403'))->toString());
    // Loading node entity.
    $node = $this->entityTypeManager()->getStorage('node')->load($nid);
    if (!empty($node)) {
      // Page content type validation and siteapikey value checking.
      if ($node->getType() == 'page' && $siteapikey == $this->config('system.site')->get('siteapikey')) {
        // Fetching all field list from node object.
        $fieldList = array_keys($node->getFields());
        // Building data array of node field values.
        foreach ($fieldList as $singleField) {
          $data[$singleField] = $node->get($singleField)->getValue();
        }
        // Building json response.
        $response = new JsonResponse($data);
      }
    }
    // Returning controller response.
    return $response;
  }
}
