<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Student\Controller\Student' => 'Student\Controller\StudentController',
        ),
    ),

	'router' => array(
        'routes' => array(
            'student' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/student[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Student\Controller\Student',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
	
	'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        /*'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),*/
		
        'template_path_stack' => array(
           'student' => __DIR__ . '/../view',
        ),
    ),
);