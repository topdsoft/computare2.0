<?php
App::uses('CustomerPopUpsController', 'Controller');

/**
 * CustomerPopUpsController Test Case
 *
 */
class CustomerPopUpsControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.customer_pop_up',
		'app.user',
		'app.form',
		'app.form_group',
		'app.user_group',
		'app.forms_group',
		'app.groups_user',
		'app.menu',
		'app.forms_menu',
		'app.menus_user',
		'app.forms_user'
	);

}
