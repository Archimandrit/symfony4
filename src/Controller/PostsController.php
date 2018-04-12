<?php

namespace App\Controller;

use App\Entity\Posts;
use App\Form\AddPostType;
use App\Helpers\FileHelper;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PostsController extends Controller
{
    /**
     * @Route("/posts", name="get_posts")
     */
    public function getPosts(Request $request)
    {
        $search = $request->get('search');
        dump($search);
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('App:Posts')->getFeed($search);

        return $this->render('posts/list.html.twig', [
            'posts' => $posts,
        ]);
    }
    /**
     * @Route("/posts/add", name="add_posts")
     */
    public function addPost(Request $request)
    {
        $post = new Posts();
        $form = $this->createForm(AddPostType::class, $post);
        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            $filename = $post->getFile()->getClientOriginalName();
            $extension = FileHelper::getExtension($filename);
            if(!in_array($extension, Posts::FILE_EXTENSION))
        {
            $error = new FormError("Формат $extension недопустим");
            $form->get('file')->addError($error);
        }
        }



        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
            $this->addFlash('success','Пост добавлен');
        }
        return $this->render('posts/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     *
     * @Route("/posts/{postId}", name="get_post", requirements={"postId"="\d+"})
     */
    public function getDetailed ($postId)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('App:Posts')->find($postId);

        return $this->render('posts/detailed.html.twig', [
            'post' => $post,
        ]);
    }
}
