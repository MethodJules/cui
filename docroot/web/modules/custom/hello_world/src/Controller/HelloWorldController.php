<?php
namespace Drupal\hello_world\controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\examples\Utility\DescriptionTemplateTrait;

class HelloWorldController extends ControllerBase {
    public function content() {
       // return ['#markup' => 'Hello, World'];
       return [
           '#type' => 'markup',
           '#markup' => $this->t('Hello, World!'),
       ]; 
    }
}