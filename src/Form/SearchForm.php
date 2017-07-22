<?php

namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

/**
 * SearchForm is a model-less form as search is not tied to any database tables.
 * Do not create forms like SearchForm when creating registration/login forms; 
 * they will use the UsersTable.php class for validation.  
 */
class SearchForm extends Form {

    protected function _buildSchema( Schema $schema ) {
        return $schema->addField( 'search', 'string' )
                        ->addField( 'dropDown', 'string' );
        // ->addField('body', ['type' => 'text']);
    }

    protected function _buildValidator( Validator $validator ) {
        $validator
                // allow the search field to be empty
                ->allowEmpty( 'search' )
                // calls maxLength method from Validator class to ensure length <= 30
                ->add( 'search', 'length',
                        ['rule' => ['maxLength', 30], 'message' => 'Please no more than 30 characters'] )
                // calls custom method from Validator class to run a custom regex
                ->add( 'search', 'validChars',
                        ['rule' => ['custom', '/^[[:alnum:][:blank:]]+$/'], 'message' => 'Please enter only alphabets, numbers, or spaces'] );
        return $validator;
    }

    protected function _execute( array $data ) {
        // Send an email.
        return true;
    }

}
