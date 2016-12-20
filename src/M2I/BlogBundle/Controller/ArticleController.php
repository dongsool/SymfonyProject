<?php

namespace M2I\BlogBundle\Controller;

use M2I\BlogBundle\Entity\Article;
use M2I\BlogBundle\Entity\Commentaire;
use M2I\BlogBundle\Form\ArticleType;
use M2I\BlogBundle\Form\CommentaireType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class ArticleController extends Controller
{
    public function detailAction($idArticle)
    {
        $em = $this->container->get('doctrine.orm.entity_manager');

        $articleRepository = $em->getRepository('M2IBlogBundle:Article');
        $commentairesRepository = $em->getRepository('M2IBlogBundle:Commentaire');

        $article = $articleRepository->findOneById($idArticle);
        $commentaires = $commentairesRepository->findById($article);

        return $this->render('M2IBlogBundle:Index:detail.html.twig', array('article' => $article, 'commentaires' => $commentaires));

    }

    public function editArticleAction(Request $request, $idArticle)
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $articleRepository = $em->getRepository('M2IBlogBundle:Article');

        $article = $articleRepository->findOneById($idArticle);

        $form = $this
            ->container
            ->get('form.factory')
            ->create(ArticleType::class, $article);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $article->getImage()->upload();
            $em->flush();

            return $this->redirectToRoute('m2_i_blog_homepage');
        }

        return $this->render(
            'M2IBlogBundle:Index:edit_article.html.twig',
            array('myForm' => $form->createView())
        );
    }

    public function addAction(Request $request)
    {
        // We check if the user have the ROLE_AUTHOR
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_AUTHOR')) {
          // Else we throw an exeption "Access Denied"
          throw new AccessDeniedException('Acces limité aux auteurs.');
        }
        $article = new Article();

        $form = $this
            ->container
            ->get('form.factory')
            ->create(ArticleType::class, $article);

        // Si la requête est en POST
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            $article->getImage()->upload();
            $em = $this->container->get('doctrine.orm.entity_manager');
            //dump($article->getImage());
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('m2_i_blog_add_article');
        }

        return $this->render(
            'M2IBlogBundle:Index:add_article.html.twig',
            array('form' => $form->createView())
        );
    }

    public function deleteArticleAction($idArticle)
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $articleRepository = $em->getRepository('M2IBlogBundle:Article');

        $article = $articleRepository->findOneById($idArticle);

        $em->remove($article);
        $em->flush();

        return $this->redirectToRoute('m2_i_blog_homepage');
    }
}
 ?>
