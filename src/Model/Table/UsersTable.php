<?php
namespace App\Model\Table;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
/**
 * Users Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
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
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
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
            ->integer('user_id')
            ->allowEmpty('user_id', 'create')
            ->add('user_id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);
        $validator
            ->notEmpty('username')
            ->requirePresence('username', 'create')
            ->add('username', 'unique', ['rule' => 'validateUnique', 'provider' => 'table', 'message' => 'This username has been taken']);
        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password');
        
        $validator
            ->requirePresence('confirmPassword', 'create');
                /* validated by bootstrap validator
            ->notEmpty('confirmPassword')
            ->add('confirmPassword', 'no-misspelling', ['rule' => ['compareWith', 'password'], 'message' => 'Passwords do not match']);
                 * 
                 */
        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email')
            ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table', 'message' => 'This email has already been used']);
        $validator
            ->dateTime('registered_date')
            ->allowEmpty('registered_date');
        $validator
            ->allowEmpty('token');
        $validator
            ->dateTime('last_login_date')
            ->allowEmpty('last_login_date');
        $validator
            ->allowEmpty('token');
        $validator
            ->allowEmpty('salt');
        $validator
            ->allowEmpty('role');
        
        $validator
                ->allowEmpty('terms');
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
        $rules->add($rules->isUnique(['userID']));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        return $rules;
    }
}