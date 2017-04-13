<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AssocTeamsCriterion Entity
 *
 * @property int $id
 * @property int $team_id
 * @property int $criterion_id
 * @property string $content
 * @property int $percent
 *
 * @property \App\Model\Entity\Team $team
 * @property \App\Model\Entity\Criterion $criterion
 */
class AssocTeamsCriterion extends Entity
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
