<?php

namespace Drupal\hello_world\HelloBlock;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Form\FormBuilderInterface;
use Drupal\hello_world\Form\HelloForm;
use Symfony\Component\DependencyInjection\ContainerInterface;

class HelloBlock extends BlockBase implements ContainerFactoryPluginInterface {
    protected $form_builder;

    public function __construct(array $configuration, $plugin_id, $plugin_definition, FormBuilderInterface $form_builder) {
        parent::__construct($configuration, $plugin_id, $plugin_definition) {
            $this->form_builder = $form_builder;
        }
    }

    public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
        return new static(
            $configuration, $plugin_id, $plugin_definition, $container->get('form_builder')
        );
    }

    public function build() {
        $output = [
            'description' => [
                '#markup' => $this->t('Using form provided by @classname', ['@classname' => HelloForm::class]),
            ],
        ];

        $output['form'] = $this->form_builder->getForm(HelloForm::class);
        return $output;
    }
}