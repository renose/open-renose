<?php

class User extends AppModel
{

    public $displayField = 'email';
    public $validate = array(
        'email' => array(
            'mustBeEmail' => array(
                'rule' => array('email', true),
                'message' => 'Bitte geben Sie eine gültige Email ein.',
                'last' => true),
            'mustUnique' => array(
                'rule' => 'isUnique',
                'message' => 'Diese Email ist bereits registriert.')
        ),
        'password' => array(
            'mustBeLonger' => array(
                'rule' => array('minLength', 6),
                'message' => 'Ihr Passwort muss aus Sicherheitsgründen mindestens 6 Zeichen lang sein.',
            )
        ),
        'password_confirm' => array(
            'equals' => array(
                'rule' => array('equalToField', array(
                    'this_field' => 'password_confirm',
                    'other_field' => 'password'
                    )
                ),
                'message' => 'Bitte geben Sie ihr Passwort zur Bestätigung nochmals korrekt ein.'
            )
        )
    );
    public $hasOne = array(
        'Profile' => array(
            'dependent' => true
        ),
        'Schedule' => array(
            'dependent' => true
        ),
        'UserSetting' => array(
            'dependent' => true
        )
    );
    public $hasMany = array(
        'WeeklyReport' => array(
            'dependent' => true
        )
    );

    function equalToField($data, $options)
    {
        return $data[$options['this_field']] == $this->data[$this->alias][$options['other_field']];
    }
    
    function afterSave($created)
    {
        if($created)
        {
            $this->Profile->create();
            $profile = array();
            $profile['Profile']['user_id'] = $this->data['User']['id'];
            $this->Profile->save($profile);
            
            $this->UserSetting->create();
            $user_setting = array();
            $user_setting['UserSetting']['user_id'] = $this->data['User']['id'];
            $this->UserSetting->save($user_setting);
        }
    }

}
