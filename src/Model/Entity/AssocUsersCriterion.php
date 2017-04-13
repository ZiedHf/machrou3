<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AssocUsersCriterion Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $criterion_id
 * @property string $content
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Criterion $criterion
 */
class AssocUsersCriterion extends Entity
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
        'id' => false
    ];
}
