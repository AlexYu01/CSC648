<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
<<<<<<< HEAD
 * @property int $userID
 * @property string $username
 * @property string $password
 * @property string $email
 * @property int $CreatedDate
 * @property int $LastLoginDate
 * @property string $TOKEN
 * @property string $Salt
=======
 * @property int $user_id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property \Cake\I18n\FrozenTime $registered_date
 * @property \Cake\I18n\FrozenTime $last_login_date
 * @property string $token
 * @property string $salt
 * @property int $role
 *
 * @property \App\Model\Entity\User $user
>>>>>>> 1afd4d745843686236e853b048040ef26b6b0e8e
 */
class User extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'user_id' => false
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
<<<<<<< HEAD
        'password'
=======
        'password',
        'token'
>>>>>>> 1afd4d745843686236e853b048040ef26b6b0e8e
    ];
}
