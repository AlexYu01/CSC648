<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Media Model
 *
 * @property \App\Model\Table\MediaTable|\Cake\ORM\Association\BelongsTo $Media
 * @property \App\Model\Table\MediaGenresTable|\Cake\ORM\Association\BelongsTo $MediaGenres
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\MediaTypesTable|\Cake\ORM\Association\BelongsTo $MediaTypes
 *
 * @method \App\Model\Entity\Media get($primaryKey, $options = [])
 * @method \App\Model\Entity\Media newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Media[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Media|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Media patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Media[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Media findOrCreate($search, callable $callback = null, $options = [])
 */
class MediaTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize( array $config ) {
        parent::initialize( $config );

        $this->setTable( 'media' );
        $this->setDisplayField( 'media_id' );
        $this->setPrimaryKey( 'media_id' );

        $this->belongsTo( 'Media', [
            'foreignKey' => 'media_id',
            'joinType' => 'INNER'
        ] );
        $this->belongsTo( 'MediaGenres', [
            'foreignKey' => 'genre_id',
            'joinType' => 'INNER'
        ] );
        $this->belongsTo( 'Users', [
            'foreignKey' => 'author_id',
            'joinType' => 'INNER'
        ] );
        $this->belongsTo( 'MediaTypes', [
            'foreignKey' => 'type_id',
            'joinType' => 'INNER'
        ] );
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault( Validator $validator ) {
        $validator
                ->requirePresence( 'media_title', 'create' )
                ->notEmpty( 'media_title' );

        $validator
                ->decimal( 'price' )
                ->requirePresence( 'price', 'create' )
                ->notEmpty( 'price' );

        $validator
                ->dateTime( 'upload_date' )
                ->allowEmpty( 'upload_date' );

        $validator
                ->integer( 'permission' )
                ->requirePresence( 'permission', 'create' )
                ->notEmpty( 'permission' );

        $validator
                ->requirePresence( 'media_link', 'create' )
                ->notEmpty( 'media_link' );

        $validator
                ->integer( 'sold_count' )
                ->allowEmpty( 'sold_count' );

        $validator
                ->allowEmpty( 'media_desc' );

        /* Requires a field called 'file' in forms related to creation of an entry.
         * File cannot be more than 30MB. File must be jpeg, jpg etc. File cannot be empty (default).
         */
        $validator
                ->requirePresence( 'file', 'create' )
                ->notEmpty( 'file' )
                ->add( 'file', [
                    'validSize' => ['rule' => ['fileSize', '<=', '30MB'], 'message' => 'Max 30MB'],
                    'validFormat' => ['rule' => ['uploadedFile', ['types' => ['image/jpeg',
                                    'image/jpg', 'image/png', 'image/gif', 'video/avi',
                                    'video/wmv', 'video/flv', 'video/mpg', 'video/mp4']]],
                        'message' => 'Accepted formats: .jpg .jpeg .png .gif .avi .wmv .flv .mpg .mp4']] );

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules( RulesChecker $rules ) {
        $rules->add( $rules->existsIn( ['media_id'], 'Media' ) );
        $rules->add( $rules->existsIn( ['genre_id'], 'MediaGenres' ) );
        $rules->add( $rules->existsIn( ['author_id'], 'Users' ) );
        $rules->add( $rules->existsIn( ['type_id'], 'MediaTypes' ) );

        return $rules;
    }

}
