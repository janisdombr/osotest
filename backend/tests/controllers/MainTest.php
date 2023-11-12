<?php
use PHPUnit\Framework\TestCase;
/**
 * @covers Main
 * @uses   Main
 * @covers Main::index
 * @uses   Main::index
 */
class MainControllerTest extends TestCase {

    protected $CI;
    protected $controller;

    // protected function setUp(): void {
    //     // Bootstrap the CodeIgniter framework
    //     $this->CI =& get_instance();

    //     // Load the Main controller
    //     //$this->CI->load->controller('main');
    //     require_once APPPATH . 'controllers/Main.php';
    //     $this->controller = new Main();
    //     //$this->controller = $this->CI->main;
    // }

    // public function testIndex() {
    //     // Simulate calling the index method
    //     $this->controller->index();

    //     // Access the view output
    //     $output = $this->CI->output->get_output();

    //     // Use regex or string functions to extract paths
    //     preg_match_all('/href="(.+?\.css)"/', $output, $cssPaths);
    //     preg_match_all('/src="(.+?\.js)"/', $output, $jsPaths);

    //     // Assert that these files exist
    //     foreach ($cssPaths[1] as $cssPath) {
    //         $this->assertFileExists(FCPATH . $cssPath);
    //     }
    //     foreach ($jsPaths[1] as $jsPath) {
    //         $this->assertFileExists(FCPATH . $jsPath);
    //     }
    // }
}
?>