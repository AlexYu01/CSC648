<?php

namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

/**
 * Model-less form that acts as the search bar
 */
class SearchForm extends Form {

    protected function _buildSchema( Schema $schema ) {
        return $schema->addField( 'search', 'string' )
                        ->addField( 'dropDown', 'string' );
    }

    protected function _buildValidator( Validator $validator ) {
        $validator
                // all forms created from SearchForm must have a field called search
                ->requirePresence( 'search' )
                // allow the search field to be empty
                ->allowEmpty( 'search' )
                // adds a rule to call maxLength method from Validator class to ensure length <= 30
                ->add( 'search', [
                    'length' => ['rule' => ['maxLength', 30], 'message' => 'Please enter no more than 30 characters'],
                    // adds a rule to call custom method from Validator class to run a custom regex
                    'validChars' => ['rule' => ['custom', '/^[[:alnum:][:blank:]]+$/'],
                        'message' => 'Please enter only alphabets, numbers, or spaces']
                ] );
        return $validator;
    }

    protected function _execute( array $data ) {

        return true;
    }

}
