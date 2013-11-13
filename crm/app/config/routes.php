<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/views/pages/home.ctp)...
 */
	Router::connect('/registro',			   array('controller' => 'prospects', 'action' => 'store_prospect'));
 
    Router::connect('/',                       array('controller' => 'users', 'action' => 'login'));
    //Router::connect('*:page',                       array('controller' => *, 'action' => *,array('page'=>'[0-9]+')));
    Router::connect('/kpi',                    array('controller' => 'prospects', 'action' => 'kpi'));
    Router::connect('/prospectos',             array('controller' => 'prospects', 'action' => 'index'));
    //Router::connect('/prospectos/:page',             array('controller' => 'prospects', 'action' => 'index'), array('page'=>'[0-9]+'));
    Router::connect('/checkUnique/*',             array('controller' => 'prospects', 'action' => 'checkUnique'));
    Router::connect('/agregar-prospecto',      array('controller' => 'prospects', 'action' => 'add'));
    Router::connect('/reasignar-prospeto',     array('controller' => 'prospects', 'action' => 'index'));
    Router::connect('/editar-prospecto/:id',   array('controller' => 'prospects', 'action' => 'edit'), array('id' => '[0-9]+'));
    Router::connect('/detalles-prospecto/:id', array('controller' => 'prospects', 'action' => 'view'), array('id' => '[0-9]+'));
    Router::connect('/descargar_xls',         array('controller' => 'prospects', 'action' => 'assigned_prospects_xls_download'));
    Router::connect('/graciasProspect',         array('controller' => 'prospects', 'action' => 'graciasProspect'));

    Router::connect('/agenda/*',                array('controller' => 'events', 'action' => 'index'));
    Router::connect('/agendar-evento/:id',      array('controller' => 'events', 'action' => 'schedule_event'), array('id'=>'[0-9]+'));
    Router::connect('/atender-evento/:id',      array('controller' => 'events', 'action' => 'view'), array('id'=>'[0-9]+'));

    Router::connect('/listar-usuarios',     array('controller' => 'users', 'action' => 'index'));
    Router::connect('/listar-usuarios/:page',     array('controller' => 'users', 'action' => 'index'), array('page'=>'[0-9]+'));
    Router::connect('/agregar-usuario',     array('controller' => 'users', 'action' => 'add'));

    Router::connect('/listar-lugares',      array('controller' => 'places', 'action' => 'index'));
    Router::connect('/listar-lugares/:page',     array('controller' => 'places', 'action' => 'index'), array('page'=>'[0-9]+'));
    Router::connect('/agregar-lugar',       array('controller' => 'places', 'action' => 'add'));

    Router::connect('/listar-origenes',      array('controller' => 'origins', 'action' => 'index'));
    Router::connect('/listar-origenes/:page',     array('controller' => 'origins', 'action' => 'index'), array('page'=>'[0-9]+'));
    Router::connect('/agregar-origen',      array('controller' => 'origins', 'action' => 'add'));

    Router::connect('/listar-categorias-medios',   array('controller' => 'medium_categories', 'action' => 'index'));
    Router::connect('/listar-categorias/:page',     array('controller' => 'medium_categories', 'action' => 'index'), array('page'=>'[0-9]+'));
    Router::connect('/agregar-categoria-medio',    array('controller' => 'medium_categories', 'action' => 'add'));

    Router::connect('/listar-medios',              array('controller' => 'media', 'action' => 'index'));
    Router::connect('/listar-medios/:page',     array('controller' => 'media', 'action' => 'index'), array('page'=>'[0-9]+'));
    Router::connect('/agregar-medio',              array('controller' => 'media', 'action' => 'add'));

    Router::connect('/listar-categorias-status',   array('controller' => 'status_categories', 'action' => 'index'));
    Router::connect('/listar-categorias/:page',     array('controller' => 'status_categories', 'action' => 'index'), array('page'=>'[0-9]+'));
    Router::connect('/agregar-categoria-status',   array('controller' => 'status_categories', 'action' => 'add'));

    Router::connect('/listar-status',              array('controller' => 'statuses', 'action' => 'index'));
    Router::connect('/listar-status/:page',     array('controller' => 'statuses', 'action' => 'index'), array('page'=>'[0-9]+'));
    Router::connect('/agregar-status',             array('controller' => 'statuses', 'action' => 'add'));

    


    // JSON

    Router::connect('/obtain-states-cities',        array('controller' => 'states',             'action' => 'obtainCitiesByState'));
    Router::connect('/obtain-media-from-category',  array('controller' => 'medium_categories',  'action' => 'obtainMediaByCategory'));
    Router::connect('/obtain-users-from-place',     array('controller' => 'places',             'action' => 'obtainUsersByPlace'));
    Router::connect('/obtain-status-from-category', array('controller' => 'status_categories',  'action' => 'obtainStatusByCategory'));

    // AJAX
    Router::connect('/obtain-unassigned-prospects/*',     array('controller' => 'prospects', 'action' => 'list_unassigned_prospects'));
    Router::connect('/store-prospect-ajax',               array('controller' => 'prospects', 'action' => 'store_prospect_ajax'));
    Router::connect('/store-event-ajax',                  array('controller' => 'events', 'action' => 'store_event_ajax'));
    Router::connect('/search-prospects-ajax/*',           array('controller' => 'prospects', 'action' => 'search_prospects_ajax'));
    /*Router::connect('/search-prospects-ajax/:page',           array('controller' => 'prospects', 'action' => 'search_prospects_ajax'),array('page'=>'[0-9]+'));*/
    




/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
    Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
