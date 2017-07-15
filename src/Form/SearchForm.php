<?php

namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

class SearchForm extends Form {

    protected function _buildSchema(Schema $schema) {
        return $schema->addField('search', 'string');
        // ->addField('drop down', ['type' => 'string']);
        // ->addField('body', ['type' => 'text']);
    }

    protected function _buildValidator(Validator $validator) {
        /* return $validator->add('Search', 'length', [
          'rule' => ['minLength', 1],
          'message' => 'Please enter something'
          ])->add('email', 'format', [
          'rule' => 'email',
          'message' => 'A valid email address is required',
          ]) */;
        return $validator;
    }

    protected function _execute(array $data) {
        // Send an email.
        return true;
    }

}
