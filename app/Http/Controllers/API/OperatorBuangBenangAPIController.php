<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOperatorBuangBenangAPIRequest;
use App\Http\Requests\API\UpdateOperatorBuangBenangAPIRequest;
use App\Models\OperatorBuangBenang;
use App\Repositories\OperatorBuangBenangRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class OperatorBuangBenangController
 * @package App\Http\Controllers\API
 */

class OperatorBuangBenangAPIController extends AppBaseController
{
    /** @var  OperatorBuangBenangRepository */
    private $operatorBuangBenangRepository;

    public function __construct(OperatorBuangBenangRepository $operatorBuangBenangRepo)
    {
        $this->middleware('auth:api');
        $this->operatorBuangBenangRepository = $operatorBuangBenangRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/operatorBuangBenangs",
     *      summary="Get a listing of the OperatorBuangBenangs.",
     *      tags={"OperatorBuangBenang"},
     *      description="Get all OperatorBuangBenangs",
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
     *                  @SWG\Items(ref="#/definitions/OperatorBuangBenang")
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
        $this->operatorBuangBenangRepository->pushCriteria(new RequestCriteria($request));
        $this->operatorBuangBenangRepository->pushCriteria(new LimitOffsetCriteria($request));
        $operatorBuangBenangs = $this->operatorBuangBenangRepository->all();

        return $this->sendResponse($operatorBuangBenangs->toArray(), 'Operator Buang Benangs retrieved successfully');
    }

    /**
     * @param CreateOperatorBuangBenangAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/operatorBuangBenangs",
     *      summary="Store a newly created OperatorBuangBenang in storage",
     *      tags={"OperatorBuangBenang"},
     *      description="Store OperatorBuangBenang",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="OperatorBuangBenang that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/OperatorBuangBenang")
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
     *                  ref="#/definitions/OperatorBuangBenang"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateOperatorBuangBenangAPIRequest $request)
    {
        $input = $request->all();

        $operatorBuangBenangs = $this->operatorBuangBenangRepository->create($input);

        return $this->sendResponse($operatorBuangBenangs->toArray(), 'Operator Buang Benang saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/operatorBuangBenangs/{id}",
     *      summary="Display the specified OperatorBuangBenang",
     *      tags={"OperatorBuangBenang"},
     *      description="Get OperatorBuangBenang",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of OperatorBuangBenang",
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
     *                  ref="#/definitions/OperatorBuangBenang"
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
        /** @var OperatorBuangBenang $operatorBuangBenang */
        $operatorBuangBenang = $this->operatorBuangBenangRepository->findWithoutFail($id);

        if (empty($operatorBuangBenang)) {
            return $this->sendError('Operator Buang Benang not found');
        }

        return $this->sendResponse($operatorBuangBenang->toArray(), 'Operator Buang Benang retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateOperatorBuangBenangAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/operatorBuangBenangs/{id}",
     *      summary="Update the specified OperatorBuangBenang in storage",
     *      tags={"OperatorBuangBenang"},
     *      description="Update OperatorBuangBenang",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of OperatorBuangBenang",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="OperatorBuangBenang that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/OperatorBuangBenang")
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
     *                  ref="#/definitions/OperatorBuangBenang"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateOperatorBuangBenangAPIRequest $request)
    {
        $input = $request->all();

        /** @var OperatorBuangBenang $operatorBuangBenang */
        $operatorBuangBenang = $this->operatorBuangBenangRepository->findWithoutFail($id);

        if (empty($operatorBuangBenang)) {
            return $this->sendError('Operator Buang Benang not found');
        }

        $operatorBuangBenang = $this->operatorBuangBenangRepository->update($input, $id);

        return $this->sendResponse($operatorBuangBenang->toArray(), 'OperatorBuangBenang updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/operatorBuangBenangs/{id}",
     *      summary="Remove the specified OperatorBuangBenang from storage",
     *      tags={"OperatorBuangBenang"},
     *      description="Delete OperatorBuangBenang",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of OperatorBuangBenang",
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
        /** @var OperatorBuangBenang $operatorBuangBenang */
        $operatorBuangBenang = $this->operatorBuangBenangRepository->findWithoutFail($id);

        if (empty($operatorBuangBenang)) {
            return $this->sendError('Operator Buang Benang not found');
        }

        $operatorBuangBenang->delete();

        return $this->sendResponse($id, 'Operator Buang Benang deleted successfully');
    }
}
