<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
<<<<<<< HEAD
=======
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
>>>>>>> 1afd4d745843686236e853b048040ef26b6b0e8e
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('user_id');
        $this->setPrimaryKey('user_id');
<<<<<<< HEAD
=======

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
>>>>>>> 1afd4d745843686236e853b048040ef26b6b0e8e
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
<<<<<<< HEAD
            ->integer('userID')
            ->allowEmpty('userID', 'create')
            ->add('userID', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->allowEmpty('username')
=======
            ->requirePresence('username', 'create')
            ->notEmpty('username')
>>>>>>> 1afd4d745843686236e853b048040ef26b6b0e8e
            ->add('username', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email')
            ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
<<<<<<< HEAD
            ->integer('CreatedDate')
            ->requirePresence('CreatedDate', 'create')
            ->notEmpty('CreatedDate');

        $validator
            ->integer('LastLoginDate')
            ->requirePresence('LastLoginDate', 'create')
            ->notEmpty('LastLoginDate');

        $validator
            ->allowEmpty('TOKEN');

        $validator
            ->requirePresence('Salt', 'create')
            ->notEmpty('Salt');
=======
            ->dateTime('registered_date')
            ->allowEmpty('registered_date');

        $validator
            ->dateTime('last_login_date')
            ->allowEmpty('last_login_date');

        $validator
            ->allowEmpty('token');

        $validator
            ->allowEmpty('salt');

        $validator
            ->integer('role')
            ->requirePresence('role', 'create')
            ->notEmpty('role');
>>>>>>> 1afd4d745843686236e853b048040ef26b6b0e8e

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
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->isUnique(['email']));
<<<<<<< HEAD
        $rules->add($rules->isUnique(['userID']));
=======
        $rules->add($rules->existsIn(['user_id'], 'Users'));
>>>>>>> 1afd4d745843686236e853b048040ef26b6b0e8e

        return $rules;
    }
}
