<?php

namespace Drupal\hello_world\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class HelloForm extends FormBase {
    
    public function getFormId() {
        return 'hello_world_form';
    }
    
    public function buildForm(array $form, FormStateInterface $form_state) {

        $form['vorname'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Vorname'),
            //'#description' => $this->t('Der Titel muss mind. 5 Zeichen haben.'),
            '#required' => TRUE,
        ];

        $form['nachname'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Nachname'),
            //'#description' => $this->t('Der Titel muss mind. 5 Zeichen haben.'),
            '#required' => TRUE,
        ];

        $form['check'] = array(
            '#type' => 'checkbox',
            '#title' => $this->t('Grüße senden.'),
            '#default_value' => 0,
        );
        
        $form['actions'] = [
            '#type' => 'actions',
        ];

        $form['actions']['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Submit'),
        ];

        return $form;
    }    

    public function validateForm(array &$form, FormStateInterface $form_state) {
        $vorname = $form_state->getValue('vorname');
        $nachname = $form_state->getValue('nachname');
        if (strlen($vorname) < 3) {
            $message = 'Der Vorname ist zu kurz.';
            $form_state->setErrorByName('vorname', $this->t($message));
        }

        if (strlen($nachname) < 2) {
            $message = 'Der Nachname ist zu kurz.';
            $form_state->setErrorByName('nachname', $this->t($message));
        }


    }

    public function submitForm(array &$form, FormStateInterface $form_state) {
        $vorname = $form_state->getValue('vorname');
        $nachname = $form_state->getValue('nachname');
        $this->messenger()->addMessage($this->t('Herzlich Willkommen, %vorname %nachname!', 
            ['%vorname'=>$vorname, '%nachname'=>$nachname]));

        $check = $form_state->getValue('check');
        if($check == 1) {
            $this->messenger()->addMessage($this->t('Grüße von %vorname %nachname!', 
            ['%vorname'=>$vorname, '%nachname'=>$nachname]));
        }
    }
}