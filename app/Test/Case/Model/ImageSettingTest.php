<?php
App::uses('ImageSetting', 'Model');

/**
 * ImageSetting Test Case
 *
 */
class ImageSettingTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.image_setting'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ImageSetting = ClassRegistry::init('ImageSetting');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ImageSetting);

		parent::tearDown();
	}

}
