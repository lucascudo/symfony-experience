<?php // src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LuckyController extends Controller
{
    /**
      * @Route("/lucky/number/{userNumber}.{_format}",
      *     name="lucky_number",
      *     defaults={"_format": "html"},
      *     requirements={
      *         "_format": "html|rss|json",
      *         "userNumber"="\d+"
      *     }
      * )
      */
    public function number($userNumber = 0)
    {
        $responseObject = [
          'userNumber' => $userNumber,
          'randomNumber' => mt_rand(0, 100)
        ];
        return $this->render('lucky/number.html.twig', $responseObject);
    }
}
