<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOperatorJahitAPIRequest;
use App\Http\Requests\API\UpdateOperatorJahitAPIRequest;
use App\Models\OperatorJahit;
use App\Repositories\OperatorJahitRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class OperatorJahitController
 * @package App\Http\Controllers\API
 */

class OperatorJahitAPIController extends AppBaseController
{
    /** @var  OperatorJahitRepository */
    private $operatorJahitRepository;

    public function __construct(OperatorJahitRepository $operatorJahitRepo)
    {
        $this->middleware('auth:api');
        $this->operatorJahitRepository = $operatorJahitRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/operatorJahits",
     *      summary="Get a listing of the OperatorJahits.",
     *      tags={"OperatorJahit"},
     *      description="Get all OperatorJahits",
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
     *                  @SWG\Items(ref="#/definitions/OperatorJahit")
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
        $this->operatorJahitRepository->pushCriteria(new RequestCriteria($request));
        $this->operatorJahitRepository->pushCriteria(new LimitOffsetCriteria($request));
        $operatorJahits = $this->operatorJahitRepository->all();

        return $this->sendResponse($operatorJahits->toArray(), 'Operator Jahits retrieved successfully');
    }

    /**
     * @param CreateOperatorJahitAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/operatorJahits",
     *      summary="Store a newly created OperatorJahit in storage",
     *      tags={"OperatorJahit"},
     *      description="Store OperatorJahit",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="OperatorJahit that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/OperatorJahit")
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
     *                  ref="#/definitions/OperatorJahit"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateOperatorJahitAPIRequest $request)
    {
        $input = $request->all();

        $operatorJahits = $this->operatorJahitRepository->create($input);

        return $this->sendResponse($operatorJahits->toArray(), 'Operator Jahit saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/operatorJahits/{id}",
     *      summary="Display the specified OperatorJahit",
     *      tags={"OperatorJahit"},
     *      description="Get OperatorJahit",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of OperatorJahit",
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
     *                  ref="#/definitions/OperatorJahit"
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
        /** @var OperatorJahit $operatorJahit */
        $operatorJahit = $this->operatorJahitRepository->findWithoutFail($id);

        if (empty($operatorJahit)) {
            return $this->sendError('Operator Jahit not found');
        }

        return $this->sendResponse($operatorJahit->toArray(), 'Operator Jahit retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateOperatorJahitAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/operatorJahits/{id}",
     *      summary="Update the specified OperatorJahit in storage",
     *      tags={"OperatorJahit"},
     *      description="Update OperatorJahit",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of OperatorJahit",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="OperatorJahit that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/OperatorJahit")
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
     *                  ref="#/definitions/OperatorJahit"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateOperatorJahitAPIRequest $request)
    {
        $input = $request->all();

        /** @var OperatorJahit $operatorJahit */
        $operatorJahit = $this->operatorJahitRepository->findWithoutFail($id);

        if (empty($operatorJahit)) {
            return $this->sendError('Operator Jahit not found');
        }

        $operatorJahit = $this->operatorJahitRepository->update($input, $id);

        return $this->sendResponse($operatorJahit->toArray(), 'OperatorJahit updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/operatorJahits/{id}",
     *      summary="Remove the specified OperatorJahit from storage",
     *      tags={"OperatorJahit"},
     *      description="Delete OperatorJahit",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of OperatorJahit",
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
        /** @var OperatorJahit $operatorJahit */
        $operatorJahit = $this->operatorJahitRepository->findWithoutFail($id);

        if (empty($operatorJahit)) {
            return $this->sendError('Operator Jahit not found');
        }

        $operatorJahit->delete();

        return $this->sendResponse($id, 'Operator Jahit deleted successfully');
    }
}
