<?php

namespace Drupal\jsonapi_webform_submissions\Plugin\jsonapi\FieldEnhancer;

use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\jsonapi_extras\Plugin\ResourceFieldEnhancerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Shaper\Util\Context;

/**
 * Perform additional manipulations to Webform submission data.
 *
 * @ResourceFieldEnhancer(
 *   id = "webform_submission_data",
 *   label = @Translation("Webform submission data (Unserialize data)"),
 *   description = @Translation("Transform webform submission data field into json")
 * )
 */
class WebformSubmissionDataEnhancer extends ResourceFieldEnhancerBase implements ContainerFactoryPluginInterface {

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition
    );
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [];
  }

  /**
   * {@inheritdoc}
   **
   * @param string $data
   */
  public function doUndoTransform($data, Context $context) {
    if ($this->is_serial($data)) {
      $elements = unserialize($data);
      $data = new \stdClass();

      foreach ($elements as $name => $attributes) {
        $data->{$name} = $attributes;
      }
    }

    return $data;
  }

  /**
   * {@inheritdoc}
   */
  protected function doTransform($data, Context $context) {
    return $data;
  }

  /**
   * {@inheritdoc}
   */
  public function getOutputJsonSchema() {
    return [
      'type' => 'object',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getSettingsForm(array $resource_field_info) {
    return [];
  }

  /**
   * Checks if the data is serialize
   *
   * @param $string
   *
   * @return bool
   */
  private function is_serial($string) {
    $data = @unserialize($string);
    return ($string === 'b:0;' || $data !== FALSE);
  }

}
