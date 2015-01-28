<?php
/**
 * Created by PhpStorm.
 * User: abbas
 * Date: 12/16/14
 * Time: 8:44 PM
 */
return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'Book',
    'language'=>'fa',
    // autoloading model and component classes
    'import'=>array(
        'application.models.*',
        'application.components.*',
        'application.modules.user.models.*',
        'application.modules.user.components.*',
        'application.modules.rights.*',
        'application.modules.rights.components.*',
        'ext.YiiMailer.YiiMailer',
    ),
    'modules'=>array(

        'message' => array(
           'userModel' => 'User',
           'getNameMethod' => 'getFullName',
           'getSuggestMethod' => 'getSuggest',
        ),

        'user'=>array(
            'tableUsers' => 'users',
            'tableProfiles' => 'profiles',
            'tableProfileFields' => 'profiles_fields',
            # encrypting method (php hash function)
            'hash' => 'md5',

            # send activation email
            'sendActivationMail' => true,

            # allow access for non-activated users
            'loginNotActiv' => false,

            # activate user on registration (only sendActivationMail = false)
            'activeAfterRegister' => true,

            # automatically login from registration
            'autoLogin' => true,

            # registration path
            'registrationUrl' => array('/user/registration'),

            # recovery password path
            'recoveryUrl' => array('/user/recovery'),

            # login form path
            'loginUrl' => array('/user/login'),

            # page after login
            'returnUrl' => array('/user/profile'),

            # page after logout
            'returnLogoutUrl' => array('/user/login'),
        ),
        'rights'=>array(

            'superuserName'=>'Admin', // Name of the role with super user privileges.
            'authenticatedName'=>'Authenticated',  // Name of the authenticated user role.
            'userIdColumn'=>'id', // Name of the user id column in the database.
            'userNameColumn'=>'username',  // Name of the user name column in the database.
            'enableBizRule'=>true,  // Whether to enable authorization item business rules.
            'enableBizRuleData'=>true,   // Whether to enable data for business rules.
            'displayDescription'=>true,  // Whether to use item description instead of name.
            'flashSuccessKey'=>'RightsSuccess', // Key to use for setting success flash messages.
            'flashErrorKey'=>'RightsError', // Key to use for setting error flash messages.

            'baseUrl'=>'/rights', // Base URL for Rights. Change if module is nested.
            'layout'=>'rights.views.layouts.main',  // Layout to use for displaying Rights.
            'appLayout'=>'application.views.layouts.main', // Application layout.
            'cssFile'=>'rights.css', // Style sheet file to use for Rights.
            'install'=>false,  // Whether to enable installer.
            'debug'=>false,
        ),

        'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>"abbas",
            'generatorPaths'=>array(
                'bootstrap.gii',
            ),
        ),
    ),
    'components'=>array(
        'user'=>array(
            'class'=>'RWebUser',
            // enable cookie-based authentication
            'allowAutoLogin'=>true,
            'loginUrl'=>array('/user/login'),
        ),
        'authManager'=>array(
            'class'=>'RDbAuthManager',
            'connectionID'=>'db',
            'itemTable'=>'authitem',
            'itemChildTable'=>'authitemchild',
            'assignmentTable'=>'authassignment',
            'rightsTable'=>'rights',
        ),
        'widgetFactory'=>array(
            'widgets'=>array(
                'CLinkPager'=>array(
                    'nextPageLabel'=>'next',
                    'prevPageLabel'=>'prev',
                    'header'=>'',
                    'maxButtonCount'=>5,

                ),
                'CJuiDatePicker'=>array(
                    'language'=>'ru',
                ),
            ),
        ),
        'book'=>array(
            'class'=>'BookComponent',
        ),
        'category'=>array(
            'class'=>'CategoryComponent'
        ),
        'order'=>array(
            'class'=>'OrderedBooksComponent'
        ),
        'access'=>array(
            'class'=>'Access'
        ),
        'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=book',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'tablePrefix' => '',
        ),

    ),

);