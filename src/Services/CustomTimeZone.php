<?php

namespace Drupal\specbee_custom\Services;

use Drupal\Core\Config\ConfigFactory;
use Drupal\Core\Datetime\DateFormatter;

/**
 * Class CustomTimeZone.
 *
 * @package Drupal\specbee_custom\Services
 */
class CustomTimeZone {

  /**
   * ConfigFactory service.
   *
   * @var \Drupal\Core\Config\ConfigFactory
   */
  protected $configFactory;

  /**
   * DateFormatter service.
   *
   * @var \Drupal\Core\Datetime\DateFormatter
   */
  protected $dateFormatter;

  /**
   * {@inheritdoc}
   */
  public function __construct(ConfigFactory $configFactory, DateFormatter $dateFormatter) {
    $this->configFactory = $configFactory;
    $this->dateFormatter = $dateFormatter;
  }

  /**
   * {@inheritdoc}
   */
  public function getCurrentTime() {
    $config = [];
    $timezone = $date_time = "";
    $config = $this->configFactory->get('specbee_custom.settings');
    if (!empty($config)) {
      $timezone = $config->get('timezone');
      if (!empty($timezone)) {
        $date_time = $this->dateFormatter->format(time(), 'custom', 'jS M Y - h:i A', $timezone);
      }
    }

    return $date_time;
  }

}
