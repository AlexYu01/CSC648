<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Media Entity
 *
 * @property int $media_id
 * @property string $media_title
 * @property int $genre_id
 * @property int $author_id
 * @property float $price
 * @property \Cake\I18n\FrozenTime $upload_date
 * @property int $permission
 * @property string $media_link
 * @property int $sold_count
 * @property int $type_id
 * @property string $media_desc
 *
 * @property \App\Model\Entity\Media $media
 * @property \App\Model\Entity\MediaGenre $media_genre
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\MediaType $media_type
 */
class Media extends Entity
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
        'media_id' => false
    ];
}
