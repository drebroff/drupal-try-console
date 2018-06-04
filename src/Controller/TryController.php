<?php

namespace Drupal\try_console\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\try_console_alternative\AlternativeService;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\plugin_type_example\SandwichPluginManager;


/**
 * Class TryController.
 */
class TryController extends ControllerBase {


//  public  static function create(ContainerInterface $container) {
//    $alt_say = $container->get("try_console_alternative_special.default");
//    return new static($alt_say);
////    return parent::create($container); // TODO: Change the autogenerated stub
//  }

  public $alternativeService;
  public function __construct (AlternativeService $alternative_service,
    SandwichPluginManager $sandwich_manager) {
    $this->sandwichManager = $sandwich_manager;
    $this->alternativeService = $alternative_service;
    $v = 123;
  }

  public static function create(ContainerInterface $container) {
    $alternative_special = $container->get('try_console_alternative_special.default');
    $sandwich_plugin_manager = $container->get('plugin.manager.sandwich');
    return new static(
     $alternative_special, $sandwich_plugin_manager
    );
  }
  /**
   * Hello.
   *
   * @return string
   *   Return Hello string.
   */
  public function hello($name) {
    $build = [];
    $this->alternativeService->cow_say();
    $cheese_sandwich_plugin_definition = $this->sandwichManager->getDefinition('cheese_sandwich');
    $plugin = $this->sandwichManager->createInstance($cheese_sandwich_plugin_definition['id'], ['of' => 'configuration values']);
    $description = $plugin->description();
    $a =123;
    $build['some_text'] = [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: hello with parameter(s): $name') . "<br />",
    ];
    $build['cheese_sandwich_description'] =[
      '#type' => 'markup',
      '#markup' => $description . "<br />",
    ];
    $build['order'] =[
      '#type' => 'markup',
      '#markup' => $plugin->order(['garlic', 'mayo']) . "<br />",
    ];

    return $build;
  }

}
