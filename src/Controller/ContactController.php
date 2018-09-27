<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     * @param Request $request
     * @param \Swift_Mailer $mailer
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request, \Swift_Mailer $mailer)
    {
        $form = $this->createForm(ContactType::class)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $message = (new \Swift_Message($data['subject']))
                ->setFrom($data['email'])
                ->setTo('email@adress.com')
                ->setBody(
                    $this->renderView(
                        'contact/contact.html.twig',
                        array(
                            'contactContent' => $data,
                        )
                    ),
                    'text/html'
                )
                // include a plaintext version of the message
                ->addPart(
                    $this->renderView(
                        'contact/contact.txt.twig',
                        array(
                            'contactContent' => $data,
                        )
                    ),
                    'text/plain'
                )
                //->setPriority(1)
            ;
            $mailer->send($message);
        }


        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'form' => $form->createView(),
        ]);
    }
}
