<?php
namespace App\Controller\Api;

use App\Service\RepositoryService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Swagger\Annotations as SWG;

class RepositoryController extends AbstractFOSRestController
{

    /**
     * @Rest\Get("/repositories")
     * 
     * @SWG\Response(
     *     response=200,
     *     description="Returns a list of repositories",
     * )
     * @SWG\Parameter(
     *     name="sort",
     *     in="query",
     *     type="string",
     *     default= "stars",
     *     description="The field used to sort the repositories"
     * )
     * @SWG\Parameter(
     *     name="order",
     *     in="query",
     *     type="string",
     *     default= "desc",
     *     description="The field used to define the direction of the sort field"
     * )
     * @SWG\Parameter(
     *     name="start_date",
     *     in="query",
     *     type="string",
     *     default= "2020-01-01",
     *     description="The field used to get repositories created at that date and onwards"
     * )
     * @SWG\Parameter(
     *     name="language",
     *     in="query",
     *     type="string",
     *     default= "php",
     *     description="The field used to get repositories with specific language"
     * )
     * @SWG\Parameter(
     *     name="limit",
     *     in="query",
     *     type="string",
     *     default= "15",
     *     description="The field used to limit repositories result"
     * )
     * @SWG\Tag(name="repository")
     * 
     * @param Request $request
     * @return View
     */
    public function postArticle(Request $request, RepositoryService $service): View
    {
        return View::create($service->findPaginated($request->query->all()));
    }
}