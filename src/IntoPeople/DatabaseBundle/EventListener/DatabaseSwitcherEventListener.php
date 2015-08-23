<?php

namespace IntoPeople\DatabaseBundle\EventListener;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\DBAL\Connection;
use Exception;
use Monolog\Logger;
use Symfony\Component\Security\Core\Authentication\Token\AnonymousToken;



class DatabaseSwitcherEventListener {

    private $request;
    private $connection;
    private $logger;

    public function __construct(Request $request, Connection $connection, Logger $logger, $context) {
        $this->request = $request;
        $this->connection = $connection;
        $this->logger = $logger;
		$this->context = $context;
    }


    public function onKernelRequest() {
	$currentHost = $this->request->getHttpHost();    
	$domains = explode('.', $currentHost);        

            $connection = $this->connection;
            $params     = $this->connection->getParams();

            $db_name = 'br_'.$domains[0];
            // TODO: validate that this site exists
            if ($db_name != $params['dbname']) {
			    
				if ($this->context->getToken() != null){
                if ($this->context->getToken()->getUser() != 'anon.'){
				$this->context->setToken(null);
				$this->request->getSession()->invalidate();
				}
				}
                
				
                $this->logger->debug('switching connection from '.$params['dbname'].' to '.$db_name);
                $params['dbname'] = $db_name;
                if ($connection->isConnected()) {
                    $connection->close();
                }
                $connection->__construct(
                    $params, $connection->getDriver(), $connection->getConfiguration(),
                    $connection->getEventManager()
                );

                try {
                    $connection->connect();
                } catch (Exception $e) {
                    // log and handle exception
                }
            
        }
    }
}