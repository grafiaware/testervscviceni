<?php
namespace Middleware\Web;

// kontejner
use Pes\Container\ContainerConfiguratorAbstract;
use Psr\Container\ContainerInterface;   // pro parametr closure function(ContainerInterface $c) {}

// renderery
use Component\Renderer\Html\Menu\MenuWrapRenderer;
use Component\Renderer\Html\Menu\LevelWrapRenderer;
use Component\Renderer\Html\Menu\ItemRenderer;
use Component\Renderer\Html\Menu\ItemEditableRenderer;

use Component\Renderer\Html\Paper\HeadlinedRenderer;
use Component\Renderer\Html\Paper\HeadlinedEditableRenderer;
use Component\Renderer\Html\Paper\BlockRenderer;
use Component\Renderer\Html\Paper\BlockEditableRenderer;
use Component\Renderer\Html\Generated\LanguageSelectRenderer;
use Component\Renderer\Html\Generated\SearchPhraseRenderer;
use Component\Renderer\Html\Generated\SearchResultRenderer;
use Component\Renderer\Html\Generated\ItemTypeRenderer;

use Component\Renderer\Html\ClassMap\ClassMap;

// menu
use Component\Controler\Menu\MenuComponent;
use Component\Controler\Menu\TitleMenuComponent;
use Component\ViewModel\Authored\Menu\MenuViewModel;

//component
use Component\Controler\Paper\NamedItemComponent;
use Component\Controler\Paper\PresentedItemComponent;
use Component\Controler\Generated\LanguageSelectComponent;
use Component\Controler\Generated\SearchPhraseComponent;
use Component\Controler\Generated\SearchResultComponent;
use Component\Controler\Generated\ItemTypeSelectComponent;

// viewModel
use Component\ViewModel\Authored\Paper\NamedPaperViewModel;
use Component\ViewModel\Authored\Paper\PresentedPaperViewModel;
use Component\ViewModel\Generated\LanguageSelectViewModel;
use Component\ViewModel\Generated\SearchPhraseViewModel;
use Component\ViewModel\Generated\SearchResultViewModel;
use Component\ViewModel\Generated\ItemTypeSelectViewModel;

// repo
use Model\Repository\MenuRepo;
use Model\Repository\MenuItemRepo;
use Model\Repository\MenuItemTypeRepo;
use Model\Repository\ComponentRepo;
use Model\Repository\MenuRootRepo;
use Model\Repository\PaperRepo;
use Model\Repository\LanguageRepo;
use Model\Repository\SecurityStatusRepo;
use Model\Repository\PresentationStatusRepo;

// controller
use Middleware\Web\Controller\GetController;
use Middleware\Web\ViewModel\GetViewModel;

// viewModel
use StatusModel\PresentationStatusModel;

/**
 *
 *
 * @author pes2704
 */
class ComponentContainerConfigurator extends ContainerConfiguratorAbstract {

    public function getAliases() {
        return [];
    }

    public function getServicesDefinitions() {
        return [

        #
        #  menu classmap
        #
            // default hodnoty
            'menu_edit_items' => [
                            'li' => '',
                            'li.onpath' => 'onpath',
                            'li.leaf' => 'leaf',
                            'li.presented' => 'presented',
                            'li i1.published' => 'grafia active green',
                            'li i1.notpublished' => 'grafia active red ',
                            'li i2.published' => 'grafia actual grey',
                            'li i2.notactive' => 'grafia actual yellow',
                            'li i2.notactual' => 'grafia actual orange',
                            'li i2.notactivenotactual' => 'grafia actual red',
                              //check green icon, times red icon //ui mini green left corner label //vertical green line
                            'li a' => 'item editable',   //nema_pravo //edituje_jiny
                            'li i' => '' //dropdown icon
                        ],
            'menu_edit_buttons' => [
                            'div' => 'mini ui basic icon buttons',
                            'div button' => 'ui button',
                            'div button1 i' => 'large trash icon',
                            'div button2 i' => 'large add circle icon', //zmena na paste pri vkladani z vyberu (vybrat k presunuti)
                            'div button3 i' => 'large arrow circle right icon',
                            'div button4 i' => 'large cut icon'
                        ],
            'block_edit_buttons' => [
                            'div' => 'mini ui basic icon buttons',
                            'div button' => 'ui button',
                            'div button1 i' => 'large trash icon',
                            'div button2 i' => 'large add circle icon', //zmena na paste pri vkladani z vyberu (vybrat k presunuti)
                        ],
            'waste_buttons' => [
                            'div' => 'mini ui basic icon buttons',
                            'div button' => 'ui button',
                            'div button1 i' => 'large times circle icon',
                            'div button4 i' => 'large cut icon'
                        ],
            'paper_edit_buttons' => [
                            'div' => 'mini ui basic icon buttons',
                            'div div' => 'ui button kalendar',
                            'div div i' => 'large calendar alternate icon',
                            'div button' => 'ui button',
                            'div button5 i.on' => 'large green toggle on icon',
                            'div button5 i.off' => 'large red toggle off icon',
                            'div div div' => 'edit_kalendar',
                            'div div div button' => 'ui button'
                        ],
            'menu.presmerovani.classmap' => function(ContainerInterface $c) {
                return new ClassMap (
                    [
                        'MenuWrap' => [
                            'ul' => 'ui tiny text menu',
                            ],
                        'LevelWrap' => [
                            'ul' => 'menu'
                        ],
                        'Item' => array_merge($c->get('menu_edit_items'),
                            [
                            'li' => 'item',
                            'li.onpath' => 'item onpath',
                            'li a' => '',
                            ]),
                    ]);
            },
            'menu.presmerovani.classmap.editable' => function(ContainerInterface $c) {
                return new ClassMap (
                    [
                        'MenuWrap' => [
                            'ul' => 'ui tiny text menu edit',
                            ],
                        'LevelWrap' => [
                            'ul' => 'menu'
                        ],
                        'Item' => array_merge($c->get('menu_edit_items'),
                            [
                            'li' => 'item',
                            'li.onpath' => 'item onpath',
                            'li a' => '',
                            ]),
                        'Buttons' => $c->get('menu_edit_buttons'),
                    ]
                );
            },

            'menu.vodorovne.classmap' => function(ContainerInterface $c) {
                return new ClassMap (
                    [
                        'MenuWrap' => [
                            'ul' => 'ui mini text menu left floated',
                            ],
                        'LevelWrap' => [

                        ],
                        'Item' => [
                            'li' => 'item',
                            'li.onpath' => 'item onpath',
                            'li a' => 'ui primary button',
                            ]
                    ]);
            },
            'menu.vodorovne.classmap.editable' => function(ContainerInterface $c) {
                return new ClassMap (
                    [
                        'MenuWrap' => [
                            'ul' => 'ui mini text menu edit left floated',
                            ],
                        'LevelWrap' => [
                            'ul' => 'menu'
                        ],
                        'Item' => array_merge($c->get('menu_edit_items'),
                            [
                            'li' => 'item',
                            'li.onpath' => 'item onpath',
                            'li a' => 'ui primary button',
                            ]),
//                        'Item' => $c->get('menu_edit_items'),
                        'Buttons' => $c->get('menu_edit_buttons'),
                    ]
                );
            },
            'menu.svisle.classmap' => function(ContainerInterface $c) {
                return new ClassMap (
                    [
                        'MenuWrap' => [
                            'ul' => 'ui vertical menu'
                        ],
                        'LevelWrap' => [
                            'ul' => 'menu',
                            ],
                        'Item' => $c->get('menu_edit_items'),
                    ]);
            },
            'menu.svisle.classmap.editable' => function(ContainerInterface $c) {
                return new ClassMap (
                    [
                        'MenuWrap' => [
                            'ul' => 'ui vertical menu edit'
                        ],
                        'LevelWrap' => [
                            'ul' => 'menu'
                        ],
                        'Item' => $c->get('menu_edit_items'),
                        'Buttons' => $c->get('menu_edit_buttons'),
                    ]);
            },
        #
        #  menu renderer
        #
            'menu.presmerovani.menuwraprenderer' => function(ContainerInterface $c) {
                return new MenuWrapRenderer($c->get('menu.presmerovani.classmap'));
            },
            'menu.presmerovani.levelwraprenderer' => function(ContainerInterface $c) {
                return new LevelWrapRenderer($c->get('menu.presmerovani.classmap'));
            },
            'menu.presmerovani.itemrenderer' => function(ContainerInterface $c) {
                return new ItemRenderer($c->get('menu.presmerovani.classmap'));
            },
            'menu.presmerovani.menuwraprenderer.editable' => function(ContainerInterface $c) {
                return new MenuWrapRenderer($c->get('menu.presmerovani.classmap.editable'));
            },
            'menu.presmerovani.levelwraprenderer.editable' => function(ContainerInterface $c) {
                return new LevelWrapRenderer($c->get('menu.presmerovani.classmap.editable'));
            },
            'menu.presmerovani.itemrenderer.editable' => function(ContainerInterface $c) {
                return new ItemEditableRenderer($c->get('menu.presmerovani.classmap.editable'));
            },

            'menu.vodorovne.menuwraprenderer' => function(ContainerInterface $c) {
                return new MenuWrapRenderer($c->get('menu.vodorovne.classmap'));
            },
            'menu.vodorovne.levelwraprenderer' => function(ContainerInterface $c) {
                return new LevelWrapRenderer($c->get('menu.vodorovne.classmap'));
            },
            'menu.vodorovne.itemrenderer' => function(ContainerInterface $c) {
                return new ItemRenderer($c->get('menu.vodorovne.classmap'));
            },
            'menu.vodorovne.menuwraprenderer.editable' => function(ContainerInterface $c) {
                return new MenuWrapRenderer($c->get('menu.vodorovne.classmap.editable'));
            },
            'menu.vodorovne.levelwraprenderer.editable' => function(ContainerInterface $c) {
                return new LevelWrapRenderer($c->get('menu.vodorovne.classmap.editable'));
            },
            'menu.vodorovne.itemrenderer.editable' => function(ContainerInterface $c) {
                return new ItemEditableRenderer($c->get('menu.vodorovne.classmap.editable'));
            },

            'menu.svisle.menuwraprenderer' => function(ContainerInterface $c) {
                return new MenuWrapRenderer($c->get('menu.svisle.classmap'));
            },
            'menu.svisle.levelwraprenderer' => function(ContainerInterface $c) {
                return new LevelWrapRenderer($c->get('menu.svisle.classmap'));
            },
            'menu.svisle.itemrenderer' => function(ContainerInterface $c) {
                return new ItemRenderer($c->get('menu.svisle.classmap'));
            },
            'menu.svisle.menuwraprenderer.editable' => function(ContainerInterface $c) {
                return new MenuWrapRenderer($c->get('menu.svisle.classmap.editable'));
            },
            'menu.svisle.levelwraprenderer.editable' => function(ContainerInterface $c) {
                return new LevelWrapRenderer($c->get('menu.svisle.classmap.editable'));
            },
            'menu.svisle.itemrenderer.editable' => function(ContainerInterface $c) {
                return new ItemEditableRenderer($c->get('menu.svisle.classmap.editable'));
            },

        #
        #  paper classmap
        #
            'paper.headlined.classmap' => function(ContainerInterface $c) {
                return new ClassMap (
                    ['Component' => [
                        'div'=>'ui segment',
                        'div div'=>'grafia segment headlined headline',
                        'div div headline'=>'ui header',
                        'div content'=>'grafia segment headlined content',
                        ]
                    ]
                );
            },
            'paper.headlined.editable.classmap' => function(ContainerInterface $c) {
                return new ClassMap (
                    ['Component' => [
                        'div'=>'ui segment',
                        'div div'=>'grafia segment headlined editable',
                        'div div.notpermitted'=>'grafia segment headlined notpermitted',
                        'div div.locked'=>'grafia segment headlined locked',
                        'div div div'=>'',
                        'div div div headline'=>'ui header',
                        'div div div i1.on' => 'grafia active green',
                        'div div div i1.off' => 'grafia active red ',
                        'div div div i2.on' => 'grafia actual grey',
                        'div div div i2.off' => 'grafia actual yellow',
                        'div div div i3'=>'settings icon',
                        'div div content'=>'',
                        ],
                     'Buttons' => $c->get('paper_edit_buttons'),
                    ]
                );
            },

            'paper.block.classmap' => function(ContainerInterface $c) {
                return new ClassMap (
                    ['Component' => [
                        'block'=>'grafia segment block',
                        ]
                    ]
                );
            },
            'paper.block.editable.classmap' => function(ContainerInterface $c) {
                return new ClassMap (
                    ['Component' => [
                        'block'=>'grafia segment block editable',
                        'block.notpermitted'=>'grafia segment block notpermitted',
                        'block.locked'=>'grafia segment block locked',
                        ]
                    ]
                );
            },
        #
        #  paper renderer
        #
            'paper.headlined.renderer' => function(ContainerInterface $c) {
                return new HeadlinedRenderer($c->get('paper.headlined.classmap'));
            },
            'paper.headlined.renderer.editable' => function(ContainerInterface $c) {
                return new HeadlinedEditableRenderer($c->get('paper.headlined.editable.classmap'));
            },
            'paper.block.renderer' => function(ContainerInterface $c) {
                return new BlockRenderer($c->get('paper.block.classmap'));
            },
            'paper.block.renderer.editable' => function(ContainerInterface $c) {
                return new BlockEditableRenderer($c->get('paper.block.editable.classmap'));
            },

        #
        #  generated classmap
        #
            'generated.languageselect.classmap' => function(ContainerInterface $c) {
                return new ClassMap (
                    ['Item' => [
                        'button'=>'ui basic button',
                        'button.presentedlanguage'=>'ui basic button',
                        'img'=>'jazyk-off',
                        'img.presentedlanguage'=>'jazyk-on',
                        ]
                    ]
                );
            },
        #
        #  generated renderer
        #
            LanguageSelectRenderer::class => function(ContainerInterface $c) {
                return new LanguageSelectRenderer($c->get('generated.languageselect.classmap'));
            },
            SearchPhraseRenderer::class => function(ContainerInterface $c) {
                return new SearchPhraseRenderer();
            },
            SearchResultRenderer::class => function(ContainerInterface $c) {
                return new SearchResultRenderer();
            },
            PresentationStatusModel::class => function(ContainerInterface $c) {
                return new PresentationStatusModel(
                                $c->get(SecurityStatusRepo::class),
                                $c->get(PresentationStatusRepo::class),
                                $c->get(MenuRepo::class),
                                $c->get(MenuRootRepo::class),
                                $c
                            );
                },
            GetController::class => function(ContainerInterface $c) {
                return new GetController($c->get(PresentationStatusModel::class), $c);
            },
        ];
    }

    public function getFactoriesDefinitions() {
        return [

        #
        #  menu komponenty
        #

                //$presmerovaniMenuDao->setPostItems([
                //    ['list'=>,
                //    'nazev'=>'STARÝ WEB',
                //    'altiv'=>TRUE,
                //    'aktual'=>TRUE],
                //    ['list'=>,
                //    'nazev'=>'FOTOBANKA',
                //    'altiv'=>TRUE,
                //    'aktual'=>TRUE],
                //
                //]);
                //    <li class="item"><a href="old" target="_blank">STARÝ WEB</a></li>
                //    <li class="item"><a href="old/fotobanka" target="_blank"></a></li>

            MenuViewModel::class => function(ContainerInterface $c) {
                return new MenuViewModel(
                                $c->get(SecurityStatusRepo::class),
                                $c->get(PresentationStatusRepo::class),
                                $c->get(MenuRepo::class),
                                $c->get(MenuRootRepo::class)
                            );
                },
            MenuComponent::class => function(ContainerInterface $c) {
                return new MenuComponent($c->get(MenuViewModel::class));
            },
            TitleMenuComponent::class => function(ContainerInterface $c) {
                return new TitleMenuComponent($c->get(MenuViewModel::class));
            },
            'menu.presmerovani' => function(ContainerInterface $c) {
                return $c->get(MenuComponent::class)
                        ->setRenderer($c->get('menu.presmerovani.menuwraprenderer'), $c->get('menu.presmerovani.levelwraprenderer'), $c->get('menu.presmerovani.itemrenderer'));
            },
            'menu.presmerovani.editable' => function(ContainerInterface $c) {
                return $c->get(MenuComponent::class)
                        ->setRenderer($c->get('menu.presmerovani.menuwraprenderer.editable'), $c->get('menu.presmerovani.levelwraprenderer.editable'), $c->get('menu.presmerovani.itemrenderer.editable'));
            },
            'menu.vodorovne' => function(ContainerInterface $c) {
                return $c->get(MenuComponent::class)
                        ->setRenderer($c->get('menu.vodorovne.menuwraprenderer'), $c->get('menu.vodorovne.levelwraprenderer'), $c->get('menu.vodorovne.itemrenderer'));
            },
            'menu.vodorovne.editable' => function(ContainerInterface $c) {
                return $c->get(MenuComponent::class)
                        ->setRenderer($c->get('menu.vodorovne.menuwraprenderer.editable'), $c->get('menu.vodorovne.levelwraprenderer.editable'), $c->get('menu.vodorovne.itemrenderer.editable'));
            },
            'menu.svisle' => function(ContainerInterface $c) {
                return $c->get(TitleMenuComponent::class)
                        ->setRenderer($c->get('menu.svisle.menuwraprenderer'), $c->get('menu.svisle.levelwraprenderer'), $c->get('menu.svisle.itemrenderer'));
            },
            'menu.svisle.editable' => function(ContainerInterface $c) {
                return $c->get(TitleMenuComponent::class)
                        ->setRenderer($c->get('menu.svisle.menuwraprenderer.editable'), $c->get('menu.svisle.levelwraprenderer.editable'), $c->get('menu.svisle.itemrenderer.editable'));
            },

        #
        #  paper komponenty
        #
            NamedPaperViewModel::class => function(ContainerInterface $c) {
                return new NamedPaperViewModel(
                                $c->get(SecurityStatusRepo::class),
                                $c->get(PresentationStatusRepo::class),
                                $c->get(MenuRepo::class),
                                $c->get(MenuRootRepo::class),
                                $c->get(PaperRepo::class),
                                $c->get(ComponentRepo::class)
                            );
            },
            NamedItemComponent::class => function(ContainerInterface $c) {
                return new NamedItemComponent($c->get(NamedPaperViewModel::class));
            },

            PresentedPaperViewModel::class => function(ContainerInterface $c) {
                return new PresentedPaperViewModel(
                                $c->get(SecurityStatusRepo::class),
                                $c->get(PresentationStatusRepo::class),
                                $c->get(MenuRepo::class),
                                $c->get(MenuRootRepo::class),
                                $c->get(PaperRepo::class),
                                $c->get(ComponentRepo::class)
                        );
            },
            PresentedItemComponent::class => function(ContainerInterface $c) {
                return new PresentedItemComponent($c->get(PresentedPaperViewModel::class));
            },

            'component.headlined' => function(ContainerInterface $c) {
                return $c->get(NamedItemComponent::class)->setRenderer($c->get('paper.headlined.renderer'));
            },
            'component.headlined.editable' => function(ContainerInterface $c) {
                return $c->get(NamedItemComponent::class)->setRenderer($c->get('paper.headlined.renderer.editable'));
            },
            'article.headlined' => function(ContainerInterface $c) {
                return $c->get(PresentedItemComponent::class)->setRenderer($c->get('paper.headlined.renderer'));
            },
            'article.headlined.editable' => function(ContainerInterface $c) {
                return $c->get(PresentedItemComponent::class)->setRenderer($c->get('paper.headlined.renderer.editable'));
            },
            'component.block' => function(ContainerInterface $c) {
                return $c->get(NamedItemComponent::class)->setRenderer($c->get('paper.block.renderer'));
            },
            'component.block.editable' => function(ContainerInterface $c) {
                return $c->get(NamedItemComponent::class)->setRenderer($c->get('paper.block.renderer.editable'));
            },

            // generated komponenty
            LanguageSelectComponent::class => function(ContainerInterface $c) {
                $viewModel = new LanguageSelectViewModel(
                                $c->get(SecurityStatusRepo::class),
                                $c->get(PresentationStatusRepo::class),
                                $c->get(MenuRepo::class),
                                $c->get(MenuRootRepo::class),
                                $c->get(LanguageRepo::class)
                        );
                return (new LanguageSelectComponent($viewModel))->setRenderer($c->get(LanguageSelectRenderer::class));
            },
            SearchResultComponent::class => function(ContainerInterface $c) {
                $viewModel = new SearchResultViewModel(
                                $c->get(SecurityStatusRepo::class),
                                $c->get(PresentationStatusRepo::class),
                                $c->get(MenuRepo::class),
                                $c->get(MenuRootRepo::class),
                                $c->get(MenuItemRepo::class));
                return (new SearchResultComponent($viewModel))->setRenderer($c->get(SearchResultRenderer::class));
            },

            SearchPhraseComponent::class => function(ContainerInterface $c) {
                $viewModel = new SearchPhraseViewModel(
                                $c->get(SecurityStatusRepo::class),
                                $c->get(PresentationStatusRepo::class),
                                $c->get(MenuRepo::class),
                                $c->get(MenuRootRepo::class)
                        );
                return (new SearchPhraseComponent($viewModel))->setRenderer($c->get(SearchPhraseRenderer::class));
            },

            ItemTypeSelectComponent::class => function(ContainerInterface $c) {
                $viewModel = new ItemTypeSelectViewModel(
                                $c->get(SecurityStatusRepo::class),
                                $c->get(PresentationStatusRepo::class),
                                $c->get(MenuRepo::class),
                                $c->get(MenuRootRepo::class),
                                $c->get(LanguageRepo::class),
                                $c->get(MenuItemTypeRepo::class)
                        );
                return (new ItemTypeSelectComponent($viewModel))->setRenderer(new ItemTypeRenderer());
            }
        ];
    }
}
