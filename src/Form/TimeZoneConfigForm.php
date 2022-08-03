<?php

namespace Drupal\specbee_custom\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Cache\Cache;

/**
 * Class TimeZoneConfigForm. The config form for the specbee_custom module.
 *
 * @package Drupal\specbee_custom\Form
 */
class TimeZoneConfigForm extends ConfigFormBase {

  /**
   * Config settings.
   *
   * @var string
   */
  const SETTINGS = 'specbee_custom.settings';

  /**
   *
   */
  public function getFormId() {
    return "timezone_config_form";
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      static::SETTINGS,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $config = $this->config(static::SETTINGS);

    $form['country'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Country'),
      '#default_value' => $config->get('country'),
    ];

    $form['city'] = [
      '#type' => 'textfield',
      '#title' => $this->t('City'),
      '#default_value' => $config->get('city'),
    ];

    $form['timezone'] = [
      '#type' => 'select',
      '#title' => $this->t('Timezone'),
      '#options' => [
        'America/Chicago' => "Chicago",
        'America/New_York' => "New York",
        'Asia/Tokyo' => "Tokyo",
        'Asia/Dubai' => "Dubai",
        'Asia/Kolkata' => "Kolkata",
        'Europe/Amsterdam' => "Amsterdam",
        'Europe/Oslo' => "Oslo",
        'Europe/London' => "London",
      ],
      '#default_value' => $config->get('timezone'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Retrieve the configuration.
    $this->config(static::SETTINGS)
      // Set the submitted configuration setting.
      ->set('country', $form_state->getValue('country'))
      ->set('city', $form_state->getValue('city'))
      ->set('timezone', $form_state->getValue('timezone'))
      ->save();

    Cache::invalidateTags(['timezoneblocktags']);

    parent::submitForm($form, $form_state);
  }

}
