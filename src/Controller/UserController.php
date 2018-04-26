<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 26.04.2018
 * Time: 1:06
 */

namespace App\Controller;

use App\Entity\Users;
use App\Repository\UsersRepository;
use App\Helpers\FileHelper;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class UserController extends Controller
{
    /**
     * @Route("/users"), name="get_user"
     */
//    public function getUsers123($users)
//    {
//
//        $em = $this->getDoctrine()->getManager();
//        $rep = $em->getRepository('App:Users');
//        $users = $rep->getUserInfo();
//        var_dump($users);die();
//
//    }

    public function showAction($username)
    {
        $product = $this->getDoctrine()
            ->getRepository(users::class)
            ->find($username);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$username
            );
        }

        return new Response('Check out this great product: '.$product->getName());
}