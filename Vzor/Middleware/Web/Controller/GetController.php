<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Middleware\Web\Controller;

use Pes\Application\AppFactory;
use Controller\PresentationFrontControllerAbstract;
use Model\Repository\LanguageRepo;
use Pes\Http\Factory\ResponseFactory;
use Pes\Http\Request\RequestParams;
use Component\Controler\Generated\LanguageSelectComponent;
use Component\Controler\Generated\SearchPhraseComponent;
use Component\Controler\Generated\SearchResultComponent;
use Component\ViewModel\Authored\Paper\PresentedPaperViewModel;
use Component\Controler\Generated\ItemTypeSelectComponent;

####################
use Pes\Debug\Timer;
use Pes\View\View;
use Pes\View\Template\PhpTemplate;
use Pes\View\Template\InterpolateTemplate;
use Pes\View\Recorder\RecorderProvider;
use Pes\View\Recorder\VariablesUsageRecorder;
use Pes\View\Recorder\RecordsLogger;

/**
 * Description of GetControler
 *
 * @author pes2704
 */
class GetController extends PresentationFrontControllerAbstract {

    private $isEdit;

    /**
     * Vrací pole dvojic jméno akce => role
     * @return array
     */
    public function getGrants() {
        return [
            'home' => '*',
            'paper' => '*',
            'last' => '*',
            'searchResult' => '*',];
    }

    private function isEdit() {
        if (!isset($this->isEdit)) {
            if ($this->statusModel->getSecurityStatus()->getUser()->getUserStatus()->getEdit()) {
                $this->isEdit = true;
            } else {
                $this->isEdit = false;
            }
        }
        return $this->isEdit;
    }

    ### action metody ###############

    public function home() {
        if ($this->isPermitted('home')) {
            $this->statusModel->getPresentationStatus()->setItemUid('');  // status model nastaví default uid (jazyk zachová)
            return $this->createResponse($this->getContentView());
        }
    }

    public function item($uid) {
        if ($this->isPermitted('paper')) {
            $this->statusModel->getPresentationStatus()->setItemUid($uid);
            return $this->createResponse($this->getContentView());
        }
    }

    public function last() {
        if ($this->isPermitted('last')) {
            return $this->createResponse($this->getContentView());
        }
    }

    public function searchResult() {
        if ($this->isPermitted('searchResult')) {
            /** @var SearchResultComponent $component */
            $component = $this->container->get(SearchResultComponent::class);
            $key = $this->request->getAttribute('klic', '');
            $key = $this->request->getQueryParams()['klic'];
            $contentView = $component->setSearch($key);
            return $this->createResponse($contentView);
        }
    }

##### private methods ##############################################################

    /**
     * Vrací view objekt pro zobrazení centrálního obsahu v prostoru pro "content"
     * @return type
     */
    private function getContentView() {
        /** @var PresentedPaperViewModel $presentedPaperViewModel */
        $presentedPaperViewModel = $this->container->get(PresentedPaperViewModel::class);
        if ($presentedPaperViewModel->getPaper()) {
            if ($this->isEdit()) {
                $contentView = $this->container->get('article.headlined.editable');
            } else {
                $contentView = $this->container->get('article.headlined');
            }
        } else {
            if ($this->isEdit()) {
                $contentView = $this->container->get(ItemTypeSelectComponent::class);
            } else {
                $contentView = '';
            }
        }
        return $contentView;
    }

    ### prezentace - response

    private function createResponse($contentView) {

        /* @var $user \Model\Entity\User */
//        $user = $this->getMwContainer()->get(\Model\Entity\User::class);
//        if (edit) {
//                        /* @var $handler Pes\Database\Handler\Handler */
//                        $handler = $mwContainer->get(\Pes\Database\Handler\Handler::class);
//                        $statement = $handler->query("SELECT stranka FROM activ_user WHERE user='".$user->getUser()."'");
//                        $statement->execute();
//                        if ($statement->rowCount() != 0) {
//                            $successUpdate = $handler->exec("UPDATE activ_user SET user = '".$user->getUser()."',stranka = 'null' WHERE user = '".$user->getUser()."'");
//                        } else {
//                            $successInsert = $handler->exec("INSERT INTO activ_user (user,stranka) VALUES ('".$user->getUser()."','null')");
//                        }
//        } else {
//                    $successDelete = $handler->exec("DELETE FROM activ_user WHERE user = '".$user->getUser()."' LIMIT 1");
//        }
        #### speed test ####
        $timer = new Timer();
        $timer->start();

        ## proměnné pro html a head
        $langCode = $this->statusModel->getPresentationStatus()->getLanguageCode();
        /** @var LanguageRepo $languageRepo */
        $languageRepo = $this->container->get(LanguageRepo::class);
        $language = $languageRepo->get($langCode);
        // nastavení uriInfo získaného z request (pro base path a přesměrování)
        $this->statusModel->setUriInfo($this->request->getAttribute(AppFactory::URI_INFO_ATTRIBUTE_NAME));
        $basePath = $this->statusModel->getUriInfo()->getSubdomainPath();

        $documentData = ['basePath' => $basePath, 'langCode' => $langCode];
        $layoutContextData = $this->getTemplateVariables();
        $contentData = ['content' => $contentView];
        $data = array_merge($documentData, $layoutContextData, $contentData);

        $duration['Získání dat z modelu'] = $timer->interval();

        /* @var $view View */
        $view = $this->container->get(View::class);
        $view
            ->setTemplate(new PhpTemplate('Middleware/Web/templates/layout.php'))
            ->setData($data);
        $duration['Vytvoření view s template'] = $timer->interval();

        $html = $view->getString();   // vynutí renderování už zde
        $duration['Renderování template'] = $timer->interval();

        $this->container->get(RecordsLogger::class)
                ->logRecords($this->container->get(RecorderProvider::class));
        $duration['Zápis recordu do logu'] = $timer->interval();


        #### speed test výsledky jsou viditelné ve firebugu ####
        $testHtml[] = '<div style="display: none;">';
        foreach ($duration as $message => $interval) {
            $testHtml[] = "<p>$message:$interval</p>";
        }
        $testHtml[] = '<p>Celkem web middleware: ' . $timer->runtime() . '</p>';
        $testHtml[] = '</div>';

        $html .= implode(PHP_EOL, $testHtml);



        $response = (new ResponseFactory())->createResponse();
        ##
        #   hlavičky
        ##
        $response = $response->withHeader('Content-Language', $language->getLocale());
        if ($this->statusModel->getSecurityStatus()->getUser()->getUserStatus()->getEdit()) {
            $response = $response->withHeader('Cache-Control', 'no-cache');
        } else {
            $response = $response->withHeader('Cache-Control', 'public, max-age=180');
        }

        ##
        #   body
        ##
        $size = $response->getBody()->write($html);
        $response->getBody()->rewind();
        return $response;
    }

    private function getTemplateVariables() {
        // proměnné pro templaty:
        $context = [
            'languageSelect' => $this->container->get(LanguageSelectComponent::class),
            'searchPhrase' => $this->container->get(SearchPhraseComponent::class),
        ];

        if ($this->statusModel->getSecurityStatus()->getUser()->getUserStatus()->getEdit()) {
            $context = array_merge($context, [
                'editableJsLinks' => $this->container->get(View::class)
                        ->setTemplate(new PhpTemplate('Middleware/Web/templates/layout/head/editableJsLinks.php'))
                        ->setData([
                            'tinyMCEConfig' => $this->container->get(View::class)
                                ->setTemplate(new InterpolateTemplate('Middleware/Web/templates/layout/head/tiny_config.js', '__', '__'))
                                ->setData([
                                    // pro tiny_config.js -     InterpolateTemplate
                                    'urlStylesCss' => \Middleware\Web\AppContext::getAppPublicDirectory() . 'grafia/css/styles.css',
                                    'urlPrefixTemplatesTinyMce' => \Middleware\Web\AppContext::getPublicDirectory() . 'tiny_templates/',
                                    'urlSemanticCss' => \Middleware\Web\AppContext::getAppPublicDirectory() . 'semantic/dist/semantic.min.css',
                                    'urlZkouskaCss' => \Middleware\Web\AppContext::getAppPublicDirectory() . 'grafia/css/zkouska_less.css',
                                ]),
                            'urlTinyMCE' => \Middleware\Web\AppContext::getPublicDirectory() . 'tinymce/tinymce.min.js', // "https://cloud.tinymce.com/5/tinymce.min.js"
                            'urlTinyInit' => \Middleware\Web\AppContext::getAppPublicDirectory() . 'grafia/js/TinyInitRS.js',
                            'menuItemEditScript' => \Middleware\Web\AppContext::getAppPublicDirectory() . 'menu/js/EditItemName.js',
                        ]),
                'menuPresmerovani' => $this->container->get('menu.presmerovani.editable')->setMenuRootName('l'),
                'menuVodorovne' => $this->container->get('menu.vodorovne.editable')->setMenuRootName('p'),
                'menuSvisle' => $this->container->get('menu.svisle.editable')->setMenuRootName('s'),
                'bloky' => $this->container->get('menu.svisle.editable')->setMenuRootName('block'),
                'kos' => $this->container->get('menu.svisle')->setMenuRootName('trash'),
                'aktuality' => $this->container->get('component.headlined.editable')->setComponentName('a1'),
                'nejblizsiAkce' => $this->container->get('component.headlined.editable')->setComponentName('a2'),
                'rychleOdkazy' => $this->container->get('component.headlined.editable')->setComponentName('a3'),
                'razitko' => $this->container->get('component.block.editable')->setComponentName('a4'),
                'socialniSite' => $this->container->get('component.block.editable')->setComponentName('a5'),
                'mapa' => $this->container->get('component.block.editable')->setComponentName('a6'),
                'logo' => $this->container->get('component.block.editable')->setComponentName('a7'),
                'banner' => $this->container->get('component.block.editable')->setComponentName('a8'),
            ]);
        } else {
            $context = array_merge($context, [
                'menuPresmerovani' => $this->container->get('menu.presmerovani')->setMenuRootName('l'),
                'menuVodorovne' => $this->container->get('menu.vodorovne')->setMenuRootName('p'),
                'menuSvisle' => $this->container->get('menu.svisle')->setMenuRootName('s'),
                'aktuality' => $this->container->get('component.headlined')->setComponentName('a1'),
                'nejblizsiAkce' => $this->container->get('component.headlined')->setComponentName('a2'),
                'rychleOdkazy' => $this->container->get('component.headlined')->setComponentName('a3'),
                'razitko' => $this->container->get('component.block')->setComponentName('a4'),
                'socialniSite' => $this->container->get('component.block')->setComponentName('a5'),
                'mapa' => $this->container->get('component.block')->setComponentName('a6'),
                'logo' => $this->container->get('component.block')->setComponentName('a7'),
                'banner' => $this->container->get('component.block')->setComponentName('a8'),
            ]);
        }

        if ($this->statusModel->getSecurityStatus()->getUser()->getUserName()) {
            $context = array_merge($context,
                    ['modal' =>
                                $this->container->get(View::class)
                                ->setTemplate(new PhpTemplate('Middleware/Web/templates/modal/modal_user_action.php'))
                                ->setData([
                                    'edit' => $this->statusModel->getSecurityStatus()->getUser()->getUserStatus()->getEdit(),
                                    'userName' => $this->statusModel->getSecurityStatus()->getUser()->getUserName()
                                ]),
            ]);
        } else {
            $context = array_merge($context,
                    ['modal' =>
                                $this->container->get(View::class)
                                ->setTemplate(new PhpTemplate('Middleware/Web/templates/modal/modal_login.php')),
            ]);
        }

        return $context;
    }

}
