<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * CodeIgniter DomPDF Library
 *
 * Generate PDF's from HTML in CodeIgniter
 *
 * @packge        CodeIgniter
 * @subpackage        Libraries
 * @category        Libraries
 * @author        Ardianta Pargo
 * @license        MIT License
 * @link        https://github.com/ardianta/codeigniter-dompdf
 */

use Dompdf\Dompdf;

class Pdf extends Dompdf
{
    /**
     * PDF filename
     * @var String
     */
    public $filename;
    public function __construct()
    {
        parent::__construct();
        $this->filename = "laporan.pdf";
    }
    /**
     * Get an instance of CodeIgniter
     *
     * @access    protected
     * @return    void
     */
    protected function ci()
    {
        return get_instance();
    }
    /**
     * Load a CodeIgniter view into domPDF
     *
     * @access    public
     * @param    string    $view The view to load
     * @param    array    $data The view data
     * @return    void
     */
    public function load_view($view, $data = array())
    {
        // if (!defined("DOMPDF_ENABLE_REMOTE")) {
        //     define("DOMPDF_ENABLE_REMOTE", true);
        // }
        // if (!defined("DOMPDF_ENABLE_AUTOLOAD")) {
        //     define("DOMPDF_ENABLE_AUTOLOAD", true);
        // }
        // ini_set('memory_limit', '-1');
        // require_once(APPPATH . "/dompdf/dompdf_config.inc.php");
        // require_once(APPPATH . "dompdf/include/dompdf.cls.php");
        // require_once(APPPATH . "dompdf/include/canvas.cls.php");
        // spl_autoload_register('DOMPDF_autoload');
        $html = $this->ci()->load->view($view, $data, TRUE);
        $this->load_html($html);
        // Render the PDF
        $this->render();
        // Output the generated PDF to Browser
        $this->stream($this->filename, array("Attachment" => false));
    }
}
