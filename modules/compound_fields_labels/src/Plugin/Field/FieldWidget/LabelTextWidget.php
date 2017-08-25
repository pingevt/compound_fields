<?php

namespace Drupal\compound_fields_labels\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'label_text' widget.
 *
 * @FieldWidget (
 *   id = "label_text_widget",
 *   label = @Translation("Label Text default widget"),
 *   field_types = {
 *     "label_text"
 *   }
 * )
 */
class LabelTextWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return array(
      'label_size' => 15,
      'label_placeholder' => '',
      'text_size' => 60,
      'text_placeholder' => '',
    ) + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $element['label_size'] = [
      '#type' => 'number',
      '#title' => t('Size of textfield'),
      '#default_value' => $this->getSetting('label_size'),
      '#required' => TRUE,
      '#min' => 1,
    ];
    $element['label_placeholder'] = [
      '#type' => 'textfield',
      '#title' => t('Label Placeholder'),
      '#default_value' => $this->getSetting('label_placeholder'),
      '#description' => t('Text that will be shown inside the field until a value is entered. This hint is usually a sample value or a brief description of the expected format.'),
    ];
    $element['text_size'] = [
      '#type' => 'number',
      '#title' => t('Size of textfield'),
      '#default_value' => $this->getSetting('text_size'),
      '#required' => TRUE,
      '#min' => 1,
    ];
    $element['text_placeholder'] = [
      '#type' => 'textfield',
      '#title' => t('Text Placeholder'),
      '#default_value' => $this->getSetting('text_placeholder'),
      '#description' => t('Text that will be shown inside the field until a value is entered. This hint is usually a sample value or a brief description of the expected format.'),
    ];
    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = array();

    $summary[] = t('Label size: @size', ['@size' => $this->getSetting('label_size')]);
    $label_placeholder = $this->getSetting('label_placeholder');
    if (!empty($label_placeholder)) {
      $summary[] = t('Label Placeholder: @placeholder', ['@placeholder' => $label_placeholder]);
    }

    $summary[] = t('Textfield size: @size', ['@size' => $this->getSetting('text_size')]);
    $placeholder = $this->getSetting('text_placeholder');
    if (!empty($placeholder)) {
      $summary[] = t('Placeholder: @placeholder', ['@placeholder' => $placeholder]);
    }

    return $summary;
  }


  /**
   * {@inheritdoc}
   */
  public function formElement(
    FieldItemListInterface $items,
    $delta,
    array $element,
    array &$form,
    FormStateInterface $form_state
  ) {
    /** @var \Drupal\link\LinkItemInterface $item */
    $item = $items[$delta];

    $element['label_value'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#default_value' => isset($items[$delta]->label_value) ? $items[$delta]->label_value : NULL,
      '#size' => $this->getSetting('label_size'),
      '#placeholder' => $this->getSetting('label_placeholder'),
      '#maxlength' => $this->getFieldSetting('label_max_length'),
      '#attributes' => ['class' => ['js-text-full', 'text-full']],
    ];

    $element['text_value'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Value'),
      '#default_value' => isset($items[$delta]->text_value) ? $items[$delta]->text_value : NULL,
      '#size' => $this->getSetting('text_size'),
      '#placeholder' => $this->getSetting('text_placeholder'),
      '#maxlength' => $this->getFieldSetting('text_max_length'),
      '#attributes' => ['class' => ['js-text-full', 'text-full']],
    ];

    // If cardinality is 1, ensure a label is output for the field by wrapping
    // it in a details element.
    if ($this->fieldDefinition->getFieldStorageDefinition()->getCardinality() == 1) {
      $element += array(
        '#type' => 'fieldset',
        //'#attributes' => array('class' => array('container-inline')),
      );
    }

    return $element;
  }
}
