<?php
App::uses('OAuthAppModel', 'OAuth.Model');

/**
 * RefreshToken Model
 *
 * @property Client $Client
 * @property User $User
 */
class RefreshToken extends OAuthAppModel {

    public $useTable = 'oauth2_clients';

    /**
     * Primary key field
     *
     * @var string
     */
    public $primaryKey = 'refresh_token';

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'refresh_token';

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'refresh_token' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            ),
            'isUnique' => array(
                'rule' => array('isUnique'),
            )
        ),
        'client_id' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            ),
        ),
        'user_id' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            ),
        ),
        'expires' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            ),
        ),
    );

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Client' => array(
            'className' => 'OAuth.Client',
            'foreignKey' => 'client_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    /**
     * beforeSave method to hash tokens before saving
     *
     * @return boolean
     */
    public function beforeSave($options = array()) {
        $this->data['RefreshToken']['refresh_token'] = OAuthComponent::hash($this->data['RefreshToken']['refresh_token']);
        return true;
    }

}
