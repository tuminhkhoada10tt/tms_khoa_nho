<?php

App::uses('AppModel', 'Model');

/**
 * Chapter Model
 *
 * @property Field $Field
 * @property Course $Course
 */
class Chapter extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'name';
    public $actsAs = array('Containable', 'Upload.Upload' => array(
            'image' => array(
                'fields' => array(
                    'dir' => 'image_path'
                )
            )
    ));

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'name' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'field_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Field' => array(
            'className' => 'Field',
            'foreignKey' => 'field_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'created_user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'Course' => array(
            'className' => 'Course',
            'foreignKey' => 'chapter_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'TaiLieu' => array(
            'className' => 'Attachment',
            'foreignKey' => 'foreign_key',
            'dependent' => true,
            'conditions' => array(
                'TaiLieu.model' => 'Chapter',
            ),
        ),
    );

    public function createWithAttachments($data) {
        // Sanitize your images before adding them
        $dstailieu = array();
        if (!empty($data['TaiLieu'][0])) {
            foreach ($data['TaiLieu'] as $i => $tailieu) {
                if (is_array($data['TaiLieu'][$i])) {
                    // Force setting the `model` field to this model
                    $tailieu['model'] = $this->name;

                    // Unset the foreign_key if the user tries to specify it
                    if (isset($tailieu['foreign_key'])) {
                        unset($tailieu['foreign_key']);
                    }
                    $dstailieu[] = $tailieu;
                }
            }
        }
        $data['TaiLieu'] = $dstailieu;
        if (empty($data[$this->name]['id'])) {
            $this->create();
        }
        if ($this->saveAll($data)) {
            return true;
        }
    }

    public function isOwnedBy($chapter, $user) {
        return $this->field('id', array('id' => $chapter, 'user_id' => $user)) !== false;
    }

}
