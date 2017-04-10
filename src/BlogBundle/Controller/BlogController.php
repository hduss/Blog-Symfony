<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class BlogController
 * @package BlogBundle\Controller
 */
class BlogController extends Controller
{
    /**
     * Blog index action.
     *
     * @return Response
     */
    public function indexAction()
    {
        $latestPosts = $this->getDoctrine()
            ->getRepository('BlogBundle:Post')
            ->findBy([], ['publishedAt' => 'DESC'], 3);

        return $this->render('BlogBundle:Blog:index.html.twig', [
            'posts' => $latestPosts,
        ]);
    }

    /**
     * Category detail action.
     *
     * @param string $categorySlug
     *
     * @return Response
     */
## $categorySlug doit correspondre a l'URL variable dans blog.yml  ##
    public function categoryAction($categorySlug)
    {
    
        $repository = $this
        ->getDoctrine()
## Category est la class Category.php dans Entity  ##
        ->getRepository('BlogBundle:Category');

## findOneBy = SELECT * from categorie WHERE slug = $categorieSlug  ##
        $category = $repository->findOneBy(['slug' => $categorySlug]);


        if (null == $category) {
            
            throw $this->createNotFoundException('Category not Found');
        }


        return $this->render('BlogBundle:Blog:category.html.twig', ['category' => $category, ]);
    }

    /**
     * Post detail action.
     *
     * @param string $categorySlug
     * @param string $postSlug
     *
     * @return Response
     */
    public function postAction($categorySlug, $postSlug)
    {
        $repository = $this
        ->getDoctrine()
        ->getRepository('BlogBundle:Post');

        $post = $repository->findOneBy([
            'id' => $categorySlug,
            'slug' => $postSlug]);




        return $this->render('BlogBundle:Blog:post.category.html.twig');
    }
}
