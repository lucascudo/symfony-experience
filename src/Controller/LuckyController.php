<?php // src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LuckyController extends Controller
{
    /**
      * @Route("/lucky/number/{userNumber}", name="lucky_number", requirements={"userNumber"="\d+"})
      */
    public function number($userNumber = 0)
    {
        return $this->render('lucky/number.html.twig', [
          'userNumber' => $userNumber,
          'randomNumber' => mt_rand(0, 100)
        ]);
    }
}
