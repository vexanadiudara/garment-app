<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOperatorGosokAPIRequest;
use App\Http\Requests\API\UpdateOperatorGosokAPIRequest;
use App\Models\OperatorGosok;
use App\Repositories\OperatorGosokRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class OperatorGosokController
 * @package App\Http\Controllers\API
 */

class OperatorGosokAPIController extends AppBaseController
{
    /** @var  OperatorGosokRepository */
    private $operatorGosokRepository;

    public function __construct(OperatorGosokRepository $operatorGosokRepo)
    {
        $this->middleware('auth:api');
        $this->operatorGosokRepository = $operatorGosokRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/operatorGosoks",
     *      summary="Get a listing of the OperatorGosoks.",
     *      tags={"OperatorGosok"},
     *      description="Get all OperatorGosoks",
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
     *                  @SWG\Items(ref="#/definitions/OperatorGosok")
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
        $this->operatorGosokRepository->pushCriteria(new RequestCriteria($request));
        $this->operatorGosokRepository->pushCriteria(new LimitOffsetCriteria($request));
        $operatorGosoks = $this->operatorGosokRepository->all();

        return $this->sendResponse($operatorGosoks->toArray(), 'Operator Gosoks retrieved successfully');
    }

    /**
     * @param CreateOperatorGosokAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/operatorGosoks",
     *      summary="Store a newly created OperatorGosok in storage",
     *      tags={"OperatorGosok"},
     *      description="Store OperatorGosok",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="OperatorGosok that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/OperatorGosok")
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
     *                  ref="#/definitions/OperatorGosok"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateOperatorGosokAPIRequest $request)
    {
        $input = $request->all();

        $operatorGosoks = $this->operatorGosokRepository->create($input);

        return $this->sendResponse($operatorGosoks->toArray(), 'Operator Gosok saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/operatorGosoks/{id}",
     *      summary="Display the specified OperatorGosok",
     *      tags={"OperatorGosok"},
     *      description="Get OperatorGosok",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of OperatorGosok",
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
     *                  ref="#/definitions/OperatorGosok"
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
        /** @var OperatorGosok $operatorGosok */
        $operatorGosok = $this->operatorGosokRepository->findWithoutFail($id);

        if (empty($operatorGosok)) {
            return $this->sendError('Operator Gosok not found');
        }

        return $this->sendResponse($operatorGosok->toArray(), 'Operator Gosok retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateOperatorGosokAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/operatorGosoks/{id}",
     *      summary="Update the specified OperatorGosok in storage",
     *      tags={"OperatorGosok"},
     *      description="Update OperatorGosok",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of OperatorGosok",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="OperatorGosok that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/OperatorGosok")
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
     *                  ref="#/definitions/OperatorGosok"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateOperatorGosokAPIRequest $request)
    {
        $input = $request->all();

        /** @var OperatorGosok $operatorGosok */
        $operatorGosok = $this->operatorGosokRepository->findWithoutFail($id);

        if (empty($operatorGosok)) {
            return $this->sendError('Operator Gosok not found');
        }

        $operatorGosok = $this->operatorGosokRepository->update($input, $id);

        return $this->sendResponse($operatorGosok->toArray(), 'OperatorGosok updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/operatorGosoks/{id}",
     *      summary="Remove the specified OperatorGosok from storage",
     *      tags={"OperatorGosok"},
     *      description="Delete OperatorGosok",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of OperatorGosok",
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
        /** @var OperatorGosok $operatorGosok */
        $operatorGosok = $this->operatorGosokRepository->findWithoutFail($id);

        if (empty($operatorGosok)) {
            return $this->sendError('Operator Gosok not found');
        }

        $operatorGosok->delete();

        return $this->sendResponse($id, 'Operator Gosok deleted successfully');
    }
}
