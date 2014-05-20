<?php

App::uses('AppModel', 'Model');

/**
 * CoursesRoom Model
 *
 * @property Course $Course
 * @property Room $Room
 * @property CreatedUser $CreatedUser
 */
class CoursesRoom extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'title';
    public $actsAs = array('Containable');

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'title' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Nhập tên buổi'
            ),
            'mustUnique' => array(
                'rule' => array('checkTenDuyNhat', 'course_id'),
                'message' => 'Đã có buổi tên này thuộc khóa học rồi.',
                'on' => 'create'
            )
        ,
        ),
        'priority' => array(
            'mustUnique' => array(
                'rule' => array('checkUuTienDuyNhat', 'course_id'),
                'message' => 'Đã có buổi học trong khóa với độ ưu tiên này.',
                'on' => 'create'
            )
        ),
        'course_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Chưa có khóa học',
            ),
        ),
        'room_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Chưa chọn phòng',
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
        'Course' => array(
            'className' => 'Course',
            'foreignKey' => 'course_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Room' => array(
            'className' => 'Room',
            'foreignKey' => 'room_id',
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

    public function checkTenDuyNhat($check, $course_id) {
        $conditions = array('CoursesRoom.course_id' => $this->data[$this->name][$course_id], 'CoursesRoom.title like' => $check['title']);
        $existing = $this->find('count', array('conditions' => $conditions));

        return($existing < 1);
    }

    public function checkUuTienDuyNhat($check, $course_id) {
        $conditions = array('CoursesRoom.course_id' => $this->data[$this->name][$course_id], 'CoursesRoom.priority' => $check['priority']);
        $existing = $this->find('count', array('conditions' => $conditions));

        return($existing < 1);
    }
}
