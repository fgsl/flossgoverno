<?php

/**
 * @see       https://github.com/laminas/laminas-mvc-skeleton for the canonical source repository
 * @copyright https://github.com/laminas/laminas-mvc-skeleton/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-mvc-skeleton/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace Application;

use Application\Controller\CategoriaDeSoftwareController;
use Application\Controller\CategoriaDeSoftwareControllerFactory;
use Application\Controller\CategoriaMaisUsadaController;
use Application\Controller\CategoriaMaisUsadaControllerFactory;
use Application\Controller\IndexController;
use Application\Controller\IndicadorController;
use Application\Controller\IndicadorControllerFactory;
use Application\Controller\LicencaController;
use Application\Controller\LicencaControllerFactory;
use Application\Controller\LicencaMaisUsadaController;
use Application\Controller\LicencaMaisUsadaControllerFactory;
use Application\Controller\MaiorOrgaoUsuarioController;
use Application\Controller\MaiorOrgaoUsuarioControllerFactory;
use Application\Controller\OrgaoController;
use Application\Controller\OrgaoControllerFactory;
use Application\Controller\ProtocoloController;
use Application\Controller\ProtocoloControllerFactory;
use Application\Controller\ProtocoloDeOrgaoController;
use Application\Controller\ProtocoloDeOrgaoControllerFactory;
use Application\Controller\SoftwareController;
use Application\Controller\SoftwareControllerFactory;
use Application\Controller\SoftwareDeOrgaoController;
use Application\Controller\SoftwareDeOrgaoControllerFactory;
use Application\Controller\SoftwareMaisUsadoController;
use Application\Controller\SoftwareMaisUsadoControllerFactory;
use Application\Controller\TipoDeOrgaoController;
use Application\Controller\TipoDeOrgaoControllerFactory;
use Laminas\Form\View\Helper\Form;
use Laminas\Form\View\Helper\FormCheckbox;
use Laminas\Form\View\Helper\FormElement;
use Laminas\Form\View\Helper\FormElementErrors;
use Laminas\Form\View\Helper\FormHidden;
use Laminas\Form\View\Helper\FormInput;
use Laminas\Form\View\Helper\FormLabel;
use Laminas\Form\View\Helper\FormNumber;
use Laminas\Form\View\Helper\FormRow;
use Laminas\Form\View\Helper\FormSelect;
use Laminas\Form\View\Helper\FormSubmit;
use Laminas\Form\View\Helper\FormText;
use Laminas\Form\View\Helper\FormTextarea;
use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;
use Application\Controller\MaiorTipoDeOrgaoUsuarioController;
use Application\Controller\MaiorTipoDeOrgaoUsuarioControllerFactory;

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
                    'route'    => '/orgao[/:action[/:key]]',
                    'defaults' => [
                        'controller' => 'orgao',
                        'action'     => 'index',
                    ],
                ],
            ],
            'tipo-de-orgao' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/tipo-de-orgao[/:action[/:key]]',
                    'defaults' => [
                        'controller' => 'tipo-de-orgao',
                        'action'     => 'index',
                    ],
                ],
            ],
            'software' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/software[/[:action[/:key[/filtern/:filtern/filterv/:filterv]]]]',
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
                    'route'    => '/categoria-de-software[/:action[/:key]]',
                    'defaults' => [
                        'controller' => 'categoria-de-software',
                        'action'     => 'index',
                    ],
                ],
            ],
            'licenca' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/licenca[/:action[/:key]]',
                    'defaults' => [
                        'controller' => 'licenca',
                        'action'     => 'index',
                    ],
                ],
            ],
            'protocolo' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/protocolo[/:action[/:key]]',
                    'defaults' => [
                        'controller' => 'protocolo',
                        'action'     => 'index',
                    ],
                ],
            ],
            'software-de-orgao' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/software-de-orgao[/:action[/:key[/filtern/:filtern/filterv/:filterv]]]',
                    'defaults' => [
                        'controller' => 'software-de-orgao',
                        'action'     => 'index',
                    ],
                ],
            ],
            'protocolo-de-orgao' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/protocolo-de-orgao[/:action[/:key]]',
                    'defaults' => [
                        'controller' => 'protocolo-de-orgao',
                        'action'     => 'index',
                    ],
                ],
            ],
            'software-mais-usado' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/software-mais-usado[/:action[/:key]]',
                    'defaults' => [
                        'controller' => 'software-mais-usado',
                        'action'     => 'index',
                    ],
                ],
            ],
            'categoria-mais-usada' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/categoria-mais-usada[/:action[/:key]]',
                    'defaults' => [
                        'controller' => 'categoria-mais-usada',
                        'action'     => 'index',
                    ],
                ],
            ],
            'maior-orgao-usuario' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/maior-orgao-usuario[/:action[/:key]]',
                    'defaults' => [
                        'controller' => 'maior-orgao-usuario',
                        'action'     => 'index',
                    ],
                ],
            ],
            'maior-tipo-orgao-usuario' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/maior-tipo-orgao-usuario[/:action[/:key]]',
                    'defaults' => [
                        'controller' => 'maior-tipo-de-orgao-usuario',
                        'action'     => 'index',
                    ],
                ],
            ],
            'licenca-mais-usada' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/licenca-mais-usada[/:action[/:key]]',
                    'defaults' => [
                        'controller' => 'licenca-mais-usada',
                        'action'     => 'index',
                    ],
                ],
            ],
            'indicador' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/indicador[/:action[/:key]]',
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
            'index'                         => IndexController::class,
            'tipo-de-orgao'                 => TipoDeOrgaoController::class,
            'orgao'                         => OrgaoController::class,
            'licenca'                       => LicencaController::class,
            'software'                      => SoftwareController::class,
            'categoria-de-software'         => CategoriaDeSoftwareController::class,
            'protocolo'                     => ProtocoloController::class,
            'software-de-orgao'             => SoftwareDeOrgaoController::class,
            'protocolo-de-orgao'            => ProtocoloDeOrgaoController::class,
            'software-mais-usado'           => SoftwareMaisUsadoController::class,
            'categoria-mais-usada'          => CategoriaMaisUsadaController::class,
            'maior-orgao-usuario'           => MaiorOrgaoUsuarioController::class,
            'maior-tipo-de-orgao-usuario'   => MaiorTipoDeOrgaoUsuarioController::class,
            'licenca-mais-usada'            => LicencaMaisUsadaController::class,
            'indicador'                     => IndicadorController::class            
        ],
        'factories' => [
            IndexController::class                      => InvokableFactory::class,
            TipoDeOrgaoController::class                => TipoDeOrgaoControllerFactory::class,
            OrgaoController::class                      => OrgaoControllerFactory::class,
            LicencaController::class                    => LicencaControllerFactory::class,
            SoftwareController::class                   => SoftwareControllerFactory::class,
            CategoriaDeSoftwareController::class        => CategoriaDeSoftwareControllerFactory::class,
            ProtocoloController::class                  => ProtocoloControllerFactory::class,
            SoftwareDeOrgaoController::class            => SoftwareDeOrgaoControllerFactory::class,
            ProtocoloDeOrgaoController::class           => ProtocoloDeOrgaoControllerFactory::class,
            SoftwareMaisUsadoController::class          => SoftwareMaisUsadoControllerFactory::class,
            CategoriaMaisUsadaController::class         => CategoriaMaisUsadaControllerFactory::class,
            MaiorOrgaoUsuarioController::class          => MaiorOrgaoUsuarioControllerFactory::class,
            MaiorTipoDeOrgaoUsuarioController::class    => MaiorTipoDeOrgaoUsuarioControllerFactory::class,
            LicencaMaisUsadaController::class           => LicencaMaisUsadaControllerFactory::class,
            IndicadorController::class                  => IndicadorControllerFactory::class
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