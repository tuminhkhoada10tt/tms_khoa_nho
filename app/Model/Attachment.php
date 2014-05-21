<?php

App::uses('AppModel', 'Model');

class Attachment extends AppModel {

    public $actsAs = array(
        'Upload.Upload' => array(
            'attachment'
        ),
    );
    public $belongsTo = array(
        'Course' => array(
            'className' => 'Course',
            'foreignKey' => 'foreign_key',
        ),
        'Chapter' => array(
            'className' => 'Chapter',
            'foreignKey' => 'foreign_key',
        )
    );

}
