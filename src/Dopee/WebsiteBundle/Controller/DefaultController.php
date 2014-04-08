<?php

namespace Dopee\WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Dopee\WebsiteBundle\Form\ContactType;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('DopeeWebsiteBundle:Default:index.html.twig', array('name' => $name));
    }

    public function contactAction(Request $request)
    {
        $form = $this->createForm(new ContactType());

        if ($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();

            $form->handleRequest($request);

            if ($form->isValid()) {
                $message = \Swift_Message::newInstance()
                    ->setSubject($form->get('subject')->getData())
                    ->setFrom($form->get('email')->getData())
                    ->setTo('sander@dope-e.nl')
                    ->setBody(
                    $this->renderView(
                        'DopeeWebsiteBundle:Mail:contact.html.twig',
                        array(
                            'ip' => $request->getClientIp(),
                            'name' => $form->get('name')->getData(),
                            'message' => $form->get('message')->getData()
                        )
                    )
                );

                $contactObj = $form->getData();

                $contactObj->setIp($request->getClientIp());
                $contactObj->setPostedAt(new \DateTime());

                $em->persist($contactObj);
                $em->flush();

                $this->get('mailer')->send($message);

                $request->getSession()->getFlashBag()->add('success', 'Je bericht is verzonden. Bedankt!');

                return $this->redirect($this->generateUrl('dopee_website_contactform'));
            }
        }

        return $this->render('DopeeWebsiteBundle:Default:contact.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
