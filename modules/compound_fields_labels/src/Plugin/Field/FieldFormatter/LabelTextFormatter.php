<?php

namespace Drupal\compound_fields_labels\Plugin\Field\FieldFormatter;

use Drupal\Core\Entity\EntityManagerInterface;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Plugin implementation of the 'label_text' formatter.
 *
 * @FieldFormatter(
 *   id = "label_text_formatter",
 *   label = @Translation("Label & Plain text"),
 *   field_types = {
 *     "label_text",
 *   },
 *   quickedit = {
 *     "editor" = "label_text"
 *   }
 * )
 */
class LabelTextFormatter extends  FormatterBase {
  // TODO add in label suffix.

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $element = array();

    foreach ($items as $delta => $item) {
      $elements[$delta] = [
        '#type' => 'inline_template',
        '#template' => '<span>{{ label_value|nl2br }}</span> {{ text_value|nl2br }}',
        '#context' => [
          'label_value' => $item->label_value,
          'text_value' => $item->text_value
        ],
      ];
    }

    return $elements;
  }
}
