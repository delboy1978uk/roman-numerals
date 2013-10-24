<?php
/**
 * User: delboy1978uk
 * Date: 23/10/2013
 * Time: 01:18
 */

return array(
    'controllers' => array(
        'invokables' => array(
            'RomanNumerals\Controller\RomanNumerals' => 'RomanNumerals\Controller\RomanNumeralsController',
        ),
    ),

    'router' => array(
        'routes' => array(
            'roman-numerals' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/roman-numerals[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'RomanNumerals\Controller\RomanNumerals',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'roman-numerals' => __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
);