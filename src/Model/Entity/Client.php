<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
//use Cake\Auth\DefaultPasswordHasher;
/**
 * Client Entity
 *
 * @property int $id
 * @property string $name
 * @property string $lastName
 * @property string $password
 * @property string $email
 * @property string $description
 * @property string $path_image
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property int $created_by
 * @property int $modified_by
 *
 * @property \App\Model\Entity\AssocClientsProject[] $assoc_clients_projects
 */
class Client extends Entity
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

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    /*protected $_hidden = [
        'password'
    ];*/
    /*protected function _setPassword($password)
    {
        return (new DefaultPasswordHasher)->hash($password);
    }*/
}
