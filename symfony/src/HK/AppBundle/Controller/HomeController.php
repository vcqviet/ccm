<?php

namespace HK\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use HK\CoreBundle\Master\MasterFrontEndController;
use HK\CoreBundle\Configuration\Configuration;
use HK\CoreBundle\Entity\Telesale;
use HK\CoreBundle\Helper\SessionHelper;
use HK\CoreBundle\Entity\Order;
use HK\CoreBundle\Helper\DateTimeHelper;
use HK\CoreBundle\Helper\NumberHelper;
use HK\CoreBundle\Entity\Ward;
use HK\CoreBundle\Entity\District;
use HK\CoreBundle\Entity\City;
use HK\CoreBundle\Entity\PhoneProvider;
use HK\CoreBundle\Entity\Product;

class HomeController extends MasterFrontEndController
{

    public function setLanguage(Request $req): Response
    {
        $lang = $req->get('rblang', '');
        Configuration::instance()->setCurrentLang($lang);
        return $this->okJson([
            'lang' => Configuration::instance()->getCurrentLang()
        ]);
    }

    public function index(Request $req): Response
    {
        return $this->redirect('/admin/login');
    }

}
