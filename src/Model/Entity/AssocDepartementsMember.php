<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AssocDepartementsMember Entity
 *
 * @property int $id
 * @property int $departement_id
 * @property int $member_id
 * @property int $accessLevel
 * @property int $departementManager
 *
 * @property \App\Model\Entity\Departement $departement
 * @property \App\Model\Entity\Member $member
 */
class AssocDepartementsMember extends Entity
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
