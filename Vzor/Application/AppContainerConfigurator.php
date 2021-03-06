<?php

namespace Application;

// kontejner
use Pes\Container\ContainerConfiguratorAbstract;
use Psr\Container\ContainerInterface;   // pro parametr closure function(ContainerInterface $c) {}

// logger
use Pes\Logger\FileLogger;

// session
use Pes\Session\SessionStatusHandler;
use Pes\Session\SessionStatusHandlerInterface;
use Pes\Session\SaveHandler\PhpLoggingSaveHandler;

//user - session
use Model\Entity\User;
use Model\Entity\UserInterface;

// database
// account a handler v middleware kontejnerech
use Pes\Database\Handler\ConnectionInfo;
use Pes\Database\Handler\DbTypeEnum;
use Pes\Database\Handler\DsnProvider\DsnProviderMysql;
use Pes\Database\Handler\OptionsProvider\OptionsProviderMysql;
use Pes\Database\Handler\AttributesProvider\AttributesProvider;


// model
// dao
use Model\Dao\StatusDao;
// repo
use Model\Repository\SecurityStatusRepo;
use Model\Repository\PresentationStatusRepo;
// statusModel
use StatusModel\SecurityStatusModel;

/**
 *
 *
 * @author pes2704
 */
class AppContainerConfigurator extends ContainerConfiguratorAbstract {

    public function getAliases() {
        return [
            SessionStatusHandlerInterface::class => SessionStatusHandler::class,
            UserInterface::class => User::class,
        ];
    }

    public function getServicesDefinitions() {
        return [

            #################################
            # Sekce konfigurace databáze
            # Konfigurace databáze může být v aplikačním kontejneru nebo různá v jednotlivých middleware kontejnerech.
            # Služby, které vrací objekty jsou v aplikačním kontejneru a v jednotlivých middleware kontejnerech musí být
            # stejná sada služeb, které vracejí hodnoty konfigurace.
            #
            'database.type' => DbTypeEnum::MySQL,
            'database.port' => '3306',
            'database.charset' => 'utf8',
            'database.collation' => 'utf8_general_ci',

            'database.development.connection.host' => 'localhost',
            'database.development.connection.name' => 'grafiacz',

            'database.production_host.connection.host' => 'xxxx',
            'database.production_host.connection.name' => 'xxxx',

            'logs.database.directory' => 'Logs/App',
            'logs.database.file' => 'Database.log',
            #
            # Konec sekce konfigurace databáze
            ###################################

            #################################
            # Sekce konfigurace session
            # Konfigurace session je vždy v aplikačním kontejneru.
            # Data session jsou používína jako globální a objekty SessionStatusHandler ani SaveHandler nejsou připraveny
            # na používání ve více instancích - používají interně PHP funkce pro práci se session a docházelo by ke kolizím při práci se session.
            #
            WebAppFactory::SESSION_NAME_SERVICE => 'www_Grafia_session',
            'logs.session.directory' => 'Logs/App',
            'logs.session.file' => 'Session.log',
            #
            # Konec sekce konfigurace session
            ##################################

            #################################
            # Kondigurace proměnné pro ukládání údajů bezpečnostního kontextu do session
//            #
            'security_session_variable_name' => 'security_context',
//            #
            #################################

            // session handler
            'sessionLogger' => function(ContainerInterface $c) {
                return FileLogger::getInstance( $c->get('logs.session.directory'), $c->get('logs.session.file'), FileLogger::REWRITE_LOG);
            },
            SessionStatusHandler::class => function(ContainerInterface $c) {
                $saveHandler = new PhpLoggingSaveHandler($c->get('sessionLogger'));
                $sessionHandler = (new SessionStatusHandler($c->get(WebAppFactory::SESSION_NAME_SERVICE), $saveHandler ));
                if (PES_DEVELOPMENT) {
                    $sessionHandler->setLogger($c->get('sessionLogger'));
                }
                return $sessionHandler;
            },

            // database
            // account a handler v middleware kontejnerech
            'databaseLogger' => function(ContainerInterface $c) {
                return FileLogger::getInstance($c->get('logs.database.directory'), $c->get('logs.database.file'), FileLogger::REWRITE_LOG); //new NullLogger();
            },
            ConnectionInfo::class => function(ContainerInterface $c) {
                if (PES_DEVELOPMENT) {
                    return new ConnectionInfo(
                            $c->get('database.type'),
                            $c->get('database.development.connection.host'),
                            $c->get('database.development.connection.name'),
                            $c->get('database.charset'),
                            $c->get('database.collation'),
                            $c->get('database.port'));
                } elseif(PES_RUNNING_ON_PRODUCTION_HOST) {
                    return new ConnectionInfo(
                            $c->get('database.type'),
                            $c->get('database.production_host.connection.host'),
                            $c->get('database.production_host.connection.name'),
                            $c->get('database.charset'),
                            $c->get('database.collation'),
                            $c->get('database.port'));
                }
            },
            DsnProviderMysql::class =>  function(ContainerInterface $c) {
                $dsnProvider = new DsnProviderMysql();
                if (PES_DEVELOPMENT) {
                    $dsnProvider->setLogger($c->get('databaseLogger'));
                }
                return $dsnProvider;
            },
            OptionsProviderMysql::class =>  function(ContainerInterface $c) {
                $optionsProvider = new OptionsProviderMysql();
                if (PES_DEVELOPMENT) {
                    $optionsProvider->setLogger($c->get('databaseLogger'));
                }
                return $optionsProvider;
            },
            AttributesProvider::class =>  function(ContainerInterface $c) {
                $attributesProvider = new AttributesProvider();
                if (PES_DEVELOPMENT) {
                    $attributesProvider->setLogger($c->get('databaseLogger'));
                }
                return $attributesProvider;
            },

            // model - pro data v session - dao používají všechny session repo v kontejnerech
            StatusDao::class => function(ContainerInterface $c) {
                return new StatusDao($c->get(SessionStatusHandler::class));
            },
            // session security status
            SecurityStatusRepo::class => function(ContainerInterface $c) {
                return new SecurityStatusRepo($c->get(StatusDao::class));
            },
            // session presentation status
            PresentationStatusRepo::class => function(ContainerInterface $c) {
                return new PresentationStatusRepo($c->get(StatusDao::class));
            },
            // viewModel s daty ukládanými v session
            SecurityStatusModel::class => function(ContainerInterface $c) {
                return (new SecurityStatusModel($c->get(SecurityStatusRepo::class)));
            },

            // session user - tato služba se používá pro vytvoření objetu Account a tedy pro připojení k databázi
            User::class => function(ContainerInterface $c) {
                /** @var SecurityStatusModel $securityStatusModel */
                $securityStatusModel = $c->get(SecurityStatusModel::class);
                $user = $securityStatusModel->getSecurityStatus()->getUser();
                return $user;
            },
        ];
    }

    public function getFactoriesDefinitions() {
        return [];
    }
}
