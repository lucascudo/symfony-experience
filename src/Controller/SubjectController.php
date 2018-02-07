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

class SubjectController extends Controller
{
    /**
     * @Route("/subject", name="subject")
     */
    public function create(Request $request, LoggerInterface $logger)
    {
        // creates a subject and gives it some dummy data for this example
        $subject = new Subject();
        $subject->setName('skulls');
        $subject->setImage('file:///home/lucas/Pictures/1469383151011-0.jpg');
        $form = $this->createForm(SubjectForm::class, $subject);;
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$subject` variable has also been updated
            $subject = $form->getData();
            // ... perform some action, such as saving the subject to the database
            // for example, if Subject is a Doctrine entity, save it!
            // $em = $this->getDoctrine()->getManager();
            // $em->persist($subject);
            // $em->flush();
            $logger->info('Created a subject', $subject->toArray());
            return $this->redirectToRoute('subject_success');
        }
        return $this->render('subject/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/subject/success", name="subject_success")
     */
    public function created(Request $request)
    {
        return $this->render('subject/created.html.twig');
    }
}
