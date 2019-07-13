<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateArticleLineAPIRequest;
use App\Http\Requests\API\UpdateArticleLineAPIRequest;
use App\Models\ArticleLine;
use App\Repositories\ArticleLineRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ArticleLineController
 * @package App\Http\Controllers\API
 */

class ArticleLineAPIController extends AppBaseController
{
    /** @var  ArticleLineRepository */
    private $articleLineRepository;

    public function __construct(ArticleLineRepository $articleLineRepo)
    {
        $this->middleware('auth:api');
        $this->articleLineRepository = $articleLineRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/articleLines",
     *      summary="Get a listing of the ArticleLines.",
     *      tags={"ArticleLine"},
     *      description="Get all ArticleLines",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/ArticleLine")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $this->articleLineRepository->pushCriteria(new RequestCriteria($request));
        $this->articleLineRepository->pushCriteria(new LimitOffsetCriteria($request));
        $articleLines = $this->articleLineRepository->all();

        return $this->sendResponse($articleLines->toArray(), 'Article Lines retrieved successfully');
    }

    /**
     * @param CreateArticleLineAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/articleLines",
     *      summary="Store a newly created ArticleLine in storage",
     *      tags={"ArticleLine"},
     *      description="Store ArticleLine",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="ArticleLine that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ArticleLine")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/ArticleLine"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateArticleLineAPIRequest $request)
    {
        $input = $request->all();

        $articleLines = $this->articleLineRepository->create($input);

        return $this->sendResponse($articleLines->toArray(), 'Article Line saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/articleLines/{id}",
     *      summary="Display the specified ArticleLine",
     *      tags={"ArticleLine"},
     *      description="Get ArticleLine",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ArticleLine",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/ArticleLine"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var ArticleLine $articleLine */
        $articleLine = $this->articleLineRepository->findWithoutFail($id);

        if (empty($articleLine)) {
            return $this->sendError('Article Line not found');
        }

        return $this->sendResponse($articleLine->toArray(), 'Article Line retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateArticleLineAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/articleLines/{id}",
     *      summary="Update the specified ArticleLine in storage",
     *      tags={"ArticleLine"},
     *      description="Update ArticleLine",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ArticleLine",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="ArticleLine that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ArticleLine")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/ArticleLine"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateArticleLineAPIRequest $request)
    {
        $input = $request->all();

        /** @var ArticleLine $articleLine */
        $articleLine = $this->articleLineRepository->findWithoutFail($id);

        if (empty($articleLine)) {
            return $this->sendError('Article Line not found');
        }

        $articleLine = $this->articleLineRepository->update($input, $id);

        return $this->sendResponse($articleLine->toArray(), 'ArticleLine updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/articleLines/{id}",
     *      summary="Remove the specified ArticleLine from storage",
     *      tags={"ArticleLine"},
     *      description="Delete ArticleLine",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ArticleLine",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var ArticleLine $articleLine */
        $articleLine = $this->articleLineRepository->findWithoutFail($id);

        if (empty($articleLine)) {
            return $this->sendError('Article Line not found');
        }

        $articleLine->delete();

        return $this->sendResponse($id, 'Article Line deleted successfully');
    }
}
