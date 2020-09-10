<?php

namespace Drupal\jsonapi_webform_submissions;

use Drupal\Core\Field\FieldItemList;
use Drupal\Core\TypedData\ComputedItemListTrait;

/**
 * Class WebformSubmissionDataItemList
 *
 * @package Drupal\jsonapi_webform_submissions
 */
class WebformSubmissionDataItemList extends FieldItemList {

  use ComputedItemListTrait;

  /**
   * {@inheritdoc}
   */
  protected function computeValue() {
    $delta = 0;
    $entity = $this->getEntity();
    $data = $entity->getData();
    $this->list[$delta] = $this->createItem($delta, serialize($data));
  }

}
