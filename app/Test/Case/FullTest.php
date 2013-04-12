<?php
class FullTest extends CakeTestSuite {
    public static function suite() {
        $suite = new CakeTestSuite('All computāre tests');
        $suite->addTestDirectory(TESTS . 'Case' . DS . 'Controller/Component');
        $suite->addTestFile(TESTS . 'Case/Controller/AddressesControllerTest.php');
        return $suite;
    }
}
 
