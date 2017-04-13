<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AssocCompaniesMember Entity
 *
 * @property int $id
 * @property int $member_id
 * @property int $company_id
 * @property int $accessLevel
 * @property int $CompanyManager
 *
 * @property \App\Model\Entity\Member $member
 * @property \App\Model\Entity\Company $company
 */
class AssocCompaniesMember extends Entity
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
