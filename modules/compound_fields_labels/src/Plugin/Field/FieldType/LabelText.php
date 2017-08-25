<?php

namespace Drupal\compound_fields_labels\Plugin\Field\FieldType;

use Drupal\Component\Utility\Random;
use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'label_text' field type.
 *
 * @FieldType (
 *   id = "label_text",
 *   label = @Translation("Label / Text (plain)"),
 *   description = @Translation("Provides Label and Text"),
 *   category = @Translation("Compound Fields"),
 *   default_widget = "label_text_widget",
 *   default_formatter = "label_text_formatter"
 * )
 */
class LabelText extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultStorageSettings() {
    return array(
      'label_max_length' => 255,
      'text_max_length' => 255,
    ) + parent::defaultStorageSettings();
  }

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return array(
      'columns' => array(
        'label_value' => array(
          'type' => 'varchar',
          'not null' => FALSE,
          'length' => (int) $field_definition->getSetting('label_max_length'),
        ),
        'text_value' => array(
          'type' => 'varchar',
          'not null' => FALSE,
          'length' => (int) $field_definition->getSetting('text_max_length'),
        ),
      ),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $description = $this->get('text_value')->getValue();
    return empty($description);
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    // Add our properties.
    $properties['label_value'] = DataDefinition::create('string')
      ->setLabel(t('Label'))
      ->setRequired(FALSE);

    $properties['text_value'] = DataDefinition::create('string')
      ->setLabel(t('Text'))
      ->setRequired(TRUE);

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public function getConstraints() {
    $constraint_manager = \Drupal::typedDataManager()->getValidationConstraintManager();
    $constraints = parent::getConstraints();

    return $constraints;
  }

  /**
   * {@inheritdoc}
   */
  public static function generateSampleValue(FieldDefinitionInterface $field_definition) {
    $random = new Random();

    // TODO: Randomize this.
    $values = array(
      'label_value' => 'Fusce dapibus',
      'text_value' => 'Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.',
    );

    return $values;
  }

  /**
   * {@inheritdoc}
   */
  public function storageSettingsForm(array &$form, FormStateInterface $form_state, $has_data) {
    $element = [];

    $element['label_max_length'] = [
      '#type' => 'number',
      '#title' => t('Label Maximum length'),
      '#default_value' => $this->getSetting('label_max_length'),
      '#required' => TRUE,
      '#description' => t('The maximum length of the label in characters.'),
      '#min' => 1,
      '#disabled' => $has_data,
    ];

    $element['text_max_length'] = [
      '#type' => 'number',
      '#title' => t('Text Maximum length'),
      '#default_value' => $this->getSetting('text_max_length'),
      '#required' => TRUE,
      '#description' => t('The maximum length of the field in characters.'),
      '#min' => 1,
      '#disabled' => $has_data,
    ];

    return $element;
  }
}