<?php

App::uses('AppModel', 'Model');

/**
 * User Model
 *
 * @property Course $Teaching
 * @property Group $Group
 * @property StudentCourse $StudentCourse
 */
class User extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'name';
    public $actsAs = array('Acl' => array('type' => 'requester'), 'Containable', 'Upload.Upload' => array(
            'avatar' => array(
                'fields' => array(
                    'dir' => 'avatar_path'
                )
            )
    ));
    public $virtualFields = array(
        'cancelledCourse' =>
        "SELECT count(id) as User__completedCourse 
         FROM  courses as TeachingCourse 
         where 
            TeachingCourse.teacher_id=User.id and 
            TeachingCourse.status=0 and 
             TeachingCourse.is_published=1
            ",
        'registeringCourse' =>
        "SELECT count(id) as User__completedCourse 
         FROM  courses as TeachingCourse 
         where 
            TeachingCourse.teacher_id=User.id and 
            TeachingCourse.status=1 and 
            TeachingCourse.is_published=1
            ",
        'uncompletedCourse' =>
        "SELECT count(id) as User__completedCourse 
         FROM  courses as TeachingCourse 
         where 
            TeachingCourse.teacher_id=User.id and 
            TeachingCourse.status=2 and 
            TeachingCourse.is_published=1
            ",
        'completedCourse' =>
        "SELECT count(id) as User__completedCourse 
         FROM  courses as TeachingCourse 
         where 
            TeachingCourse.teacher_id=User.id and 
            TeachingCourse.status=3 and 
            TeachingCourse.is_published=1
            ",
    );

    public function parentNode() {
        $a = array('completedCourse' =>
            "SELECT count(id) as User__completedCourse 
         FROM  courses as TeachingCourse 
         where 
            TeachingCourse.teacher_id=User.id and 
            TeachingCourse.status=" . COURSE_COMPLETED . "'");
        return null;
    }

    public function beforeSave($options = array()) {
        $this->data['User']['password'] = AuthComponent::password(
                        $this->data['User']['password']
        );
        return true;
    }

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
        'username' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'password' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'email' => array(
            'email' => array(
                'rule' => array('email'),
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
    );

    function RegisterValidate() {
        $validate1 = array(
            'username' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Vui lòng nhập username',
                    'last' => true),
                'mustUnique' => array(
                    'rule' => 'isUnique',
                    'message' => 'Username đã tồn tại',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('minLength', 4),
                    'message' => 'Username phải hơn 3 ký tự',
                    'last' => true),
            ),
            'name' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Vui lòng nhập tên')
            ),
            'email' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Vui lòng nhập email',
                    'last' => true),
                'mustBeEmail' => array(
                    'rule' => array('email'),
                    'message' => 'Vui lòng nhập đúng email',
                    'last' => true),
                'mustUnique' => array(
                    'rule' => 'isUnique',
                    'message' => 'Email đã tồn tại',
                )
            ),
            'password' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Vui lòng nhập mật khẩu',
                    'on' => 'create',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('minLength', 6),
                    'message' => 'Password phải nhiều hơn 5 ký tự',
                    'on' => 'create',
                    'last' => true),
                'mustMatch' => array(
                    'rule' => array('verifies'),
                    'message' => 'Mật khẩu và xác nhận mật khẩu không giống nhau'),
            //'on' => 'create'
            )
        );
        $this->validate = $validate1;
        return $this->validates();
    }

    public function verifies() {
        return ($this->data['User']['password'] === $this->data['User']['cpassword']);
    }

    public function sendRegistrationMail($user) {
        // send email to newly created user
        $userId = $user['User']['id'];
        $email = new CakeEmail();
        $fromConfig = EMAIL_FROM_ADDRESS;
        $fromNameConfig = EMAIL_FROM_NAME;
        $email->from(array($fromConfig => $fromNameConfig));
        $email->sender(array($fromConfig => $fromNameConfig));
        $email->to($user['User']['email']);
        $email->subject('Đăng ký tài khoản thành công');
        //$email->transport('Debug');
        $body = "Chào mừng " . $user['User']['name'] . ", Cảm ơn bạn đã đăng ký tại " . SITE_URL . " \n\n Thanks,\n" . EMAIL_FROM_NAME;
        try {
            $result = $email->send($body);
        } catch (Exception $ex) {
            // we could not send the email, ignore it
            $result = "Không thể gửi mail cho user id -" . $userId;
        }
        $this->log($result, LOG_DEBUG);
    }

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'TeachingCourse' => array(
            'className' => 'Course',
            'foreignKey' => 'teacher_id',
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
        'StudentsCourse' => array(
            'className' => 'StudentsCourse',
            'foreignKey' => 'student_id',
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
        'FieldManaged' => array(
            'className' => 'Field',
            'foreignKey' => 'manage_user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );
    public $belongsTo = array(
        'HocHam' => array(
            'className' => 'HocHam',
            'foreignKey' => 'hoc_ham_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'HocVi' => array(
            'className' => 'HocVi',
            'foreignKey' => 'hoc_vi_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    /**
     * hasAndBelongsToMany associations
     *
     * @var array
     */
    public $hasAndBelongsToMany = array(
        'Group' => array(
            'className' => 'Group',
            'joinTable' => 'users_groups',
            'foreignKey' => 'user_id',
            'associationForeignKey' => 'group_id',
            'unique' => 'keepExisting',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
        )
    );

}
