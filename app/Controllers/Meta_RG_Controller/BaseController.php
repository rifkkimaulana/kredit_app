<?php

namespace App\Controllers\Meta_RG_Controller;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use App\Models\AplikasiModel;
use App\Models\UsersModel;
use CodeIgniter\Controller;

class BaseController extends Controller
{

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    protected $aplikasiModel;
    protected $userModel;

    // Variable
    protected $user;
    protected $userListAdministrator;

    /**
     * Constructor.
     */
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        //--------------------------------------------------------------------
        // Preload any models, libraries, etc, here.
        //--------------------------------------------------------------------
        // E.g.:
        // $this->session = \Config\Services::session();

        // Akses UserModel
        $this->userModel = new UsersModel();
        $this->aplikasiModel = new AplikasiModel();

        // Cek sesi pengguna
        if (!session('user_level') || !(session('user_level') === 'administrator')) {
            return redirect()->to(base_url('login'))->with('error', 'Anda tidak memiliki izin akses.');
        }

        // Mendapatkan data pengguna menggunakan model berdasarkan session user_id
        $user = $this->userModel->where('user_id', session('user_id'))->first();
        $userListAdministrator = $this->userModel->where('user_level', 'administrator')->findAll();

        $this->user = $user;
        $this->userListAdministrator = $userListAdministrator;
    }
}
