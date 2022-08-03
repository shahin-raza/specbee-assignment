<?php

namespace Drupal\specbee_custom\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a 'CustomTimeZoneBlock' block.
 *
 * @Block(
 *   id = "custom_time_zone",
 *   admin_label = @Translation("Custom Time Zone"),
 *   category = @Translation("Custom Block"),
 * )
 */
class CustomTimeZoneBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Drupal\specbee_custom\Services\CustomTimeZone definition.
   *
   * @var \Drupal\specbee_custom\Services\CustomTimeZone
   */
  protected $customTimeZone;

  /**
   * Drupal\Core\Config\ConfigFactory definition.
   *
   * @var \Drupal\Core\Config\ConfigFactory
   */
  protected $configFactory;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    $instance                 = new static($configuration, $plugin_id, $plugin_definition);
    $instance->customTimeZone = $container->get('specbee_custom.timezone');
    $instance->configFactory  = $container->get('config.factory');
    return $instance;
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = [];
    $country = $city = $timezone = "";
    $config = $this->configFactory->get('specbee_custom.settings');
    if (!empty($config)) {
      $country = $config->get('country');
      $city = $config->get('city');
      $timezone = $config->get('timezone');
    }

    return [
      '#theme' => 'custom_timezone_theme',
      '#timezone' => $timezone,
      '#country' => $country,
      '#city' => $city,
      '#current_datetime' => $this->customTimeZone->getCurrentTime(),
      '#cache' => [
        'tags' => ['timezoneblocktags'],
      ],
    ];
  }

}
