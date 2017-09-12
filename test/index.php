public function setUp()
{
 
}

public function testSerialIndexPageLoads()
{
    ob_start();
    include('index.php');
    $output = ob_get_flush();
    $this->assertContains("Serial Number Registration", $output);
}