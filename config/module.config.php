<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'controllers' => array(
        'invokables' => array(
            // 'Index' => 'Album\Controller\IndexController',
            'Album' => 'Album\Controller\AlbumController',
            'Upload' => 'Album\Controller\UploadController',
            'Categories' => 'Album\Controller\CategoriesController',
            'Image' => 'Album\Controller\ImageController'
        ),
    ),    
    'router' => array(
        'routes' => array(
            'album' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/album[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Album',
                        'action'     => 'index',
                    ),
                ),
            ),
            'categories' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/categories', // danh-muc-images
                    'defaults' => array(
                        'controller' => 'Categories',
                        'action' => 'all',
                    ),
                ),
            ),
            // Literal route named "image", with child routes
            'image' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/image',
                    'defaults' => array(
                        'controller' => 'Image',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    // Segment route for view one image
                    'view' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/[:id]-[:slug]',
                            'constraints' => array(
                                'id' => '[0-9]+',
                                'slug' => '[a-zA-Z0-9_-]+',
                            ),
                            'defaults' => array(
                                'action' => 'view',
                            ),
                        ),
                    ),
                    // Literal route for viewing blog RSS feed
                    'rss' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/rss',
                            'defaults' => array(
                                'action' => 'rss',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),    
    'view_manager' => array(        
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),    
);
