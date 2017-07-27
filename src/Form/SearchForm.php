<?php

namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

/**
 * Since search is not adding, updating, or deleting an entry in a table we use
 * a model-less form like this one. For registration the form will use the 
 * UsersTable model to define its structure.
 */
class SearchForm extends Form {

    protected function _buildSchema( Schema $schema ) {
        return $schema->addField( 'search', 'string' )
                        ->addField( 'dropDown', 'string' );
        // ->addField('body', ['type' => 'text']);
    }

    protected function _buildValidator( Validator $validator ) {
        $validator
                // all forms created from SearchForm must have a field called search
                ->requirePresence( 'search' )
                // allow the search field to be empty
                ->allowEmpty( 'search' )
                // adds a rule to call maxLength method from Validator class to ensure length <= 30
                ->add( 'search', 'length',
                        ['rule' => ['maxLength', 30], 'message' => 'Please enter no more than 30 characters'] )
                // adds a rule to call custom method from Validator class to run a custom regex
                ->add( 'search', 'validChars',
                        ['rule' => ['custom', '/^[[:alnum:][:blank:]]+$/'], 'message' => 'Please enter only alphabets, numbers, or spaces'] );
        return $validator;
    }

    protected function _execute( array $data ) {

        return true;
    }

}
