<?php

namespace App\Controller;

use App\Entity\Posts;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PostsController extends Controller
{
    /**
     * @Route("/posts", name="get_posts")
     */
    public function getPosts()
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('App:Posts')->findAll();

        return $this->render('posts/list.html.twig', [
            'posts' => $posts,
        ]);
    }
    /**
     * @Route("/posts/add", name="add_posts")
     */
    public function addPost()
    {
        $post = new Posts();
        $post->setContent(123);

        $em = $this->getDoctrine()->getManager();
        $em->persist($post);
        $em->flush();

        return $this->render('posts/add.html.twig', [
            'post' => $post,
        ]);
    }
}
