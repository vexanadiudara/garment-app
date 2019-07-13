<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateStepAPIRequest;
use App\Http\Requests\API\UpdateStepAPIRequest;
use App\Models\Step;
use App\Repositories\StepRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class StepController
 * @package App\Http\Controllers\API
 */

class StepAPIController extends AppBaseController
{
    /** @var  StepRepository */
    private $stepRepository;

    public function __construct(StepRepository $stepRepo)
    {
        $this->middleware('auth:api');
        $this->stepRepository = $stepRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/steps",
     *      summary="Get a listing of the Steps.",
     *      tags={"Step"},
     *      description="Get all Steps",
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
     *                  @SWG\Items(ref="#/definitions/Step")
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
        $this->stepRepository->pushCriteria(new RequestCriteria($request));
        $this->stepRepository->pushCriteria(new LimitOffsetCriteria($request));
        $steps = $this->stepRepository->all();

        return $this->sendResponse($steps->toArray(), 'Steps retrieved successfully');
    }

    /**
     * @param CreateStepAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/steps",
     *      summary="Store a newly created Step in storage",
     *      tags={"Step"},
     *      description="Store Step",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Step that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Step")
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
     *                  ref="#/definitions/Step"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateStepAPIRequest $request)
    {
        $input = $request->all();

        $steps = $this->stepRepository->create($input);

        return $this->sendResponse($steps->toArray(), 'Step saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/steps/{id}",
     *      summary="Display the specified Step",
     *      tags={"Step"},
     *      description="Get Step",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Step",
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
     *                  ref="#/definitions/Step"
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
        /** @var Step $step */
        $step = $this->stepRepository->findWithoutFail($id);

        if (empty($step)) {
            return $this->sendError('Step not found');
        }

        return $this->sendResponse($step->toArray(), 'Step retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateStepAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/steps/{id}",
     *      summary="Update the specified Step in storage",
     *      tags={"Step"},
     *      description="Update Step",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Step",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Step that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Step")
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
     *                  ref="#/definitions/Step"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateStepAPIRequest $request)
    {
        $input = $request->all();

        /** @var Step $step */
        $step = $this->stepRepository->findWithoutFail($id);

        if (empty($step)) {
            return $this->sendError('Step not found');
        }

        $step = $this->stepRepository->update($input, $id);

        return $this->sendResponse($step->toArray(), 'Step updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/steps/{id}",
     *      summary="Remove the specified Step from storage",
     *      tags={"Step"},
     *      description="Delete Step",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Step",
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
        /** @var Step $step */
        $step = $this->stepRepository->findWithoutFail($id);

        if (empty($step)) {
            return $this->sendError('Step not found');
        }

        $step->delete();

        return $this->sendResponse($id, 'Step deleted successfully');
    }
}
