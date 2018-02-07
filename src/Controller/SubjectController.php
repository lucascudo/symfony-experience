<?php // src/Controller/SubjectController.php
namespace App\Controller;

use Psr\Log\LoggerInterface;
use App\Entity\Subject;
use App\Form\SubjectForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class SubjectController extends Controller
{
    /**
     * @Route("/subject", name="subject")
     */
    public function index(Request $request)
    {
        $subjects = $this->getDoctrine()
            ->getRepository(Subject::class)
            ->findAll();
        return $this->render('subject/index.html.twig', [
            'subjects' => $subjects,
        ]);
    }

    /**
     * @Route("/subject/create", name="subject_create")
     */
    public function create(Request $request, SessionInterface $session, LoggerInterface $logger)
    {
        $subject = new Subject();
        $subject->setName('skulls');
        $subject->setImage('file:///home/lucas/Pictures/1469383151011-0.jpg');
        $form = $this->createForm(SubjectForm::class, $subject);;
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $subject = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($subject);
            $em->flush();
            $logger->info('Created a subject', $subject->toArray());
            $session->getFlashBag()->add('success', 'Subject "' . $subject->getName() . '" created successfully');
            return $this->redirectToRoute('subject_success');
        }
        return $this->render('subject/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/subject/success", name="subject_success")
     */
    public function created(Request $request, SessionInterface $session)
    {
        return $this->render('subject/created.html.twig');
    }
}
