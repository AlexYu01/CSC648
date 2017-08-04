<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Messages Model
 *
 * @property \App\Model\Table\MessagesTable|\Cake\ORM\Association\BelongsTo $Messages
 * @property \App\Model\Table\SendersTable|\Cake\ORM\Association\BelongsTo $Senders
 * @property \App\Model\Table\ReceiversTable|\Cake\ORM\Association\BelongsTo $Receivers
 * @property \App\Model\Table\MediaTable|\Cake\ORM\Association\BelongsTo $Media
 *
 * @method \App\Model\Entity\Message get($primaryKey, $options = [])
 * @method \App\Model\Entity\Message newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Message[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Message|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Message patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Message[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Message findOrCreate($search, callable $callback = null, $options = [])
 */
class MessagesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('messages');
        $this->setDisplayField('message_id');
        $this->setPrimaryKey('message_id');
/*
        $this->belongsTo('Messages', [
            'foreignKey' => 'message_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Senders', [
            'foreignKey' => 'sender_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Receivers', [
            'foreignKey' => 'receiver_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Media', [
            'foreignKey' => 'media_id',
            'joinType' => 'INNER'
        ]);
 * 
 */
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->requirePresence('message_content', 'create')
            ->notEmpty('message_content');
        $validator
            ->requirePresence('sender_id', 'create')
            ->notEmpty('sender_id');
        $validator
            ->requirePresence('receiver_id', 'create')
            ->notEmpty('receiver_id');
        $validator
            ->requirePresence('media_id', 'create')
            ->notEmpty('media_id');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        //$rules->add($rules->isUnique(['message_id']));
        //$rules->add($rules->isUnique(['sender_id']));
        //$rules->add($rules->isUnique(['receiver_id']));
        //$rules->add($rules->isUnique(['media_id']));

        return $rules;
    }
}
