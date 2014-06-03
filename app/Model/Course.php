<?php

App::uses('AppModel', 'Model');

/**
 * Course Model
 *
 * @property Chapter $Chapter
 * @property Room $Room
 */
class Course extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'name';
    public $virtualFields = array(
        'register_student_number' =>
        "SELECT count(id) as Course__register_student_number 
         FROM  students_courses as StudentsCourse 
         where 
            StudentsCourse.course_id=Course.id 
            ");
    public $actsAs = array('Containable', 'Upload.Upload' => array(
            'image' => array(
                'fields' => array(
                    'dir' => 'image_path'
                )
            )
        )
    );

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
        'max_enroll_number' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'session_number' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'is_published' => array(
            'boolean' => array(
                'rule' => array('boolean'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'is_cancelled' => array(
            'boolean' => array(
                'rule' => array('boolean'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'status' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'chapter_id' => array(
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
        'Chapter' => array(
            'className' => 'Chapter',
            'foreignKey' => 'chapter_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Teacher' => array(
            'className' => 'User',
            'foreignKey' => 'teacher_id',
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
        'StudentsCourse' => array(
            'className' => 'StudentsCourse',
            'foreignKey' => 'student_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'CoursesRoom' => array(
            'className' => 'CoursesRoom',
            'foreignKey' => 'course_id',
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
    );
    
    public function getCoursesCompleted() {
        $conditions = array('Course.status' =>COURSE_COMPLETED);
        $coursescompleted = $this->find('all', array('conditions' => $conditions, 'recursive' => -1));
        $coursescompleted_id_array = Set::classicExtract($coursescompleted, '{n}.Course.id');
       // debug($coursescompleted_id_array);die;
        return $coursescompleted_id_array;
        
    }
    
    public function getCoursesByChapter_id($chapter_id) {
        $conditions = array('Course.chapter_id' => $chapter_id);
        $courses = $this->find('all', array('conditions' => $conditions, 'recursive' => -1));
        $courses_id_array = Set::classicExtract($courses, '{n}.Course.id');
        return $courses_id_array;
    }
    
}
