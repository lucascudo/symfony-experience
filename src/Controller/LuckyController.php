<?php // src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

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
    public function number(Request $request, SessionInterface $session, $userNumber = 0)
    {
      // use a default value if the attribute doesn't exist
      $userAgent = $session->get('user-agent', $request->headers->get('user-agent'));
      // store an attribute for reuse during a later user request
      $session->set('user-agent', $userAgent);
      $responseObject = [
        'userNumber' => (int) $userNumber,
        'randomNumber' => mt_rand(0, 100)
      ];
      return ($request->get('_format') == 'json')
        ? $this->json($responseObject)
        : $this->render('lucky/number.html.twig', $responseObject);
    }
}
