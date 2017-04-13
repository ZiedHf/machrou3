<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProjectEmployeeInfo Entity
 *
 * @property int $id
 * @property int $assoc_users_project_id
 * @property int $time_dedicated
 *
 * @property \App\Model\Entity\AssocUsersProject $assoc_users_project
 */
class ProjectEmployeeInfo extends Entity
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
