<?php

/**
 * @see       https://github.com/laminas/laminas-mvc-skeleton for the canonical source repository
 * @copyright https://github.com/laminas/laminas-mvc-skeleton/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-mvc-skeleton/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace Application;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;
use Application\Controller\IndexController;
use Application\Controller\CategoriaDeSoftwareController;
use Application\Controller\OrgaoControllerFactory;
use Application\Controller\TipoDeOrgaoControllerFactory;
use Application\Controller\OrgaoController;
use Application\Controller\LicencaController;
use Application\Controller\SoftwareController;
use Application\Controller\ProtocoloController;
use Application\Controller\TipoDeOrgaoController;
use Application\Controller\LicencaControllerFactory;
use Application\Controller\SoftwareControllerFactory;
use Application\Controller\CategoriaDeSoftwareControllerFactory;
use Application\Controller\ProtocoloControllerFactory;
use Application\Controller\SoftwareMaisUsadoController;
use Application\Controller\SoftwareMaisUsadoControllerFactory;
use Application\Controller\MaiorUsuarioController;
use Application\Controller\MaiorUsuarioControllerFactory;
use Laminas\Form\View\Helper\Form;
use Laminas\Form\View\Helper\FormCheckbox;
use Laminas\Form\View\Helper\FormElement;
use Laminas\Form\View\Helper\FormElementErrors;
use Laminas\Form\View\Helper\FormHidden;
use Laminas\Form\View\Helper\FormLabel;
use Laminas\Form\View\Helper\FormRow;
use Laminas\Form\View\Helper\FormSelect;
use Laminas\Form\View\Helper\FormSubmit;
use Laminas\Form\View\Helper\FormTextarea;
use Laminas\Form\View\Helper\FormText;
use Laminas\Form\View\Helper\FormInput;
use Laminas\Form\View\Helper\FormNumber;
use Application\Controller\SoftwareDeOrgaoController;
use Application\Controller\SoftwareDeOrgaoControllerFactory;
use Application\Controller\ProtocoloDeOrgaoController;
use Application\Controller\ProtocoloDeOrgaoControllerFactory;
use Application\Controller\LicencaMaisUsadaController;
use Application\Controller\LicencaMaisUsadaControllerFactory;
use Application\Controller\IndicadorController;
use Application\Controller\IndicadorControllerFactory;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'application' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/:controller[/:action]',
                    'defaults' => [
                        'controller' => 'index',
                        'action'     => 'index',
                    ],
                ],
            ],
            'orgao' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/orgao[/:action[/:key]][/page/:page]',
                    'defaults' => [
                        'controller' => 'orgao',
                        'action'     => 'index',
                    ],
                ],
            ],
            'tipo-de-orgao' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/tipo-de-orgao[/:action[/:key]][/page/:page]',
                    'defaults' => [
                        'controller' => 'tipo-de-orgao',
                        'action'     => 'index',
                    ],
                ],
            ],
            'software' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/software[/[:action[/:key]]]',
                    'defaults' => [
                        'controller' => 'software',
                        'action'     => 'index',
                        'page' => 1
                    ],
                  ],
            ],
            'categoria-de-software' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/categoria-de-software[/:action[/:key]][/page/:page]',
                    'defaults' => [
                        'controller' => 'categoria-de-software',
                        'action'     => 'index',
                    ],
                ],
            ],
            'licenca' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/licenca[/:action[/:key]][/page/:page]',
                    'defaults' => [
                        'controller' => 'licenca',
                        'action'     => 'index',
                    ],
                ],
            ],
            'protocolo' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/protocolo[/:action[/:key]][/page/:page]',
                    'defaults' => [
                        'controller' => 'protocolo',
                        'action'     => 'index',
                    ],
                ],
            ],
            'software-de-orgao' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/software-de-orgao[/:action[/:key]][/page/:page]',
                    'defaults' => [
                        'controller' => 'software-de-orgao',
                        'action'     => 'index',
                    ],
                ],
            ],
            'protocolo-de-orgao' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/protocolo-de-orgao[/:action[/:key]][/page/:page]',
                    'defaults' => [
                        'controller' => 'protocolo-de-orgao',
                        'action'     => 'index',
                    ],
                ],
            ],
            'software-mais-usado' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/software-mais-usado[/:action[/:key]][/page/:page]',
                    'defaults' => [
                        'controller' => 'software-mais-usado',
                        'action'     => 'index',
                    ],
                ],
            ],
            'maior-usuario' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/maior-usuario[/:action[/:key]][/page/:page]',
                    'defaults' => [
                        'controller' => 'maior-usuario',
                        'action'     => 'index',
                    ],
                ],
            ],
            'licenca-mais-usada' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/licenca-mais-usada[/:action[/:key]][/page/:page]',
                    'defaults' => [
                        'controller' => 'licenca-mais-usada',
                        'action'     => 'index',
                    ],
                ],
            ],
            'indicador' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/indicador[/:action[/:key]][/page/:page]',
                    'defaults' => [
                        'controller' => 'indicador',
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'aliases' => [
            'index'                 => IndexController::class,
            'tipo-de-orgao'         => TipoDeOrgaoController::class,
            'orgao'                 => OrgaoController::class,
            'licenca'               => LicencaController::class,
            'software'              => SoftwareController::class,
            'categoria-de-software' => CategoriaDeSoftwareController::class,
            'protocolo'             => ProtocoloController::class,
            'software-de-orgao'     => SoftwareDeOrgaoController::class,
            'protocolo-de-orgao'    => ProtocoloDeOrgaoController::class,
            'software-mais-usado'   => SoftwareMaisUsadoController::class,
            'maior-usuario'         => MaiorUsuarioController::class,
            'licenca-mais-usada'    => LicencaMaisUsadaController::class,
            'indicador'             => IndicadorController::class            
        ],
        'factories' => [
            IndexController::class                  => InvokableFactory::class,
            TipoDeOrgaoController::class            => TipoDeOrgaoControllerFactory::class,
            OrgaoController::class                  => OrgaoControllerFactory::class,
            LicencaController::class                => LicencaControllerFactory::class,
            SoftwareController::class               => SoftwareControllerFactory::class,
            CategoriaDeSoftwareController::class    => CategoriaDeSoftwareControllerFactory::class,
            ProtocoloController::class              => ProtocoloControllerFactory::class,
            SoftwareDeOrgaoController::class        => SoftwareDeOrgaoControllerFactory::class,
            ProtocoloDeOrgaoController::class       => ProtocoloDeOrgaoControllerFactory::class,
            SoftwareMaisUsadoController::class      => SoftwareMaisUsadoControllerFactory::class,
            MaiorUsuarioController::class           => MaiorUsuarioControllerFactory::class,
            LicencaMaisUsadaController::class       => LicencaMaisUsadaControllerFactory::class,
            IndicadorController::class              => IndicadorControllerFactory::class
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'view_helpers' => [
        'aliases' => [
            'form' => Form::class,
            'formcheckbox' => FormCheckbox::class,
            'form_element' => FormElement::class,
            'form_element_errors' => FormElementErrors::class,
            'formhidden' => FormHidden::class,
            'form_label' => FormLabel::class,
            'formRow' => FormRow::class,
            'formselect' => FormSelect::class,
            'formsubmit' => FormSubmit::class,
            'formtext' => FormText::class,
            'formtextarea' => FormTextarea::class,
            'formInput' => FormInput::class,
            'formnumber' => FormNumber::class
        ],
        'factories' => [
            Form::class => InvokableFactory::class,
            FormCheckbox::class => InvokableFactory::class,
            FormElement::class => InvokableFactory::class,
            FormElementErrors::class => InvokableFactory::class,
            FormHidden::class => InvokableFactory::class,
            FormLabel::class => InvokableFactory::class,
            FormRow::class => InvokableFactory::class,
            FormSelect::class => InvokableFactory::class,
            FormSubmit::class => InvokableFactory::class,
            FormText::class => InvokableFactory::class,
            FormTextarea::class => InvokableFactory::class,
            FormInput::class => InvokableFactory::class,
            FormNumber::class => InvokableFactory::class
        ]
    ]
];
