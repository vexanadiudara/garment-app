<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSuratPerintahKerjaAPIRequest;
use App\Http\Requests\API\UpdateSuratPerintahKerjaAPIRequest;
use App\Models\SuratPerintahKerja;
use App\Repositories\SuratPerintahKerjaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class SuratPerintahKerjaController
 * @package App\Http\Controllers\API
 */

class SuratPerintahKerjaAPIController extends AppBaseController
{
    /** @var  SuratPerintahKerjaRepository */
    private $suratPerintahKerjaRepository;

    public function __construct(SuratPerintahKerjaRepository $suratPerintahKerjaRepo)
    {
        $this->middleware('auth:api');
        $this->suratPerintahKerjaRepository = $suratPerintahKerjaRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/suratPerintahKerjas",
     *      summary="Get a listing of the SuratPerintahKerjas.",
     *      tags={"SuratPerintahKerja"},
     *      description="Get all SuratPerintahKerjas",
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
     *                  @SWG\Items(ref="#/definitions/SuratPerintahKerja")
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
        $this->suratPerintahKerjaRepository->pushCriteria(new RequestCriteria($request));
        $this->suratPerintahKerjaRepository->pushCriteria(new LimitOffsetCriteria($request));
        $suratPerintahKerjas = $this->suratPerintahKerjaRepository->all();

        return $this->sendResponse($suratPerintahKerjas->toArray(), 'Surat Perintah Kerjas retrieved successfully');
    }

    /**
     * @param CreateSuratPerintahKerjaAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/suratPerintahKerjas",
     *      summary="Store a newly created SuratPerintahKerja in storage",
     *      tags={"SuratPerintahKerja"},
     *      description="Store SuratPerintahKerja",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="SuratPerintahKerja that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SuratPerintahKerja")
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
     *                  ref="#/definitions/SuratPerintahKerja"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSuratPerintahKerjaAPIRequest $request)
    {
        $input = $request->all();

        $suratPerintahKerjas = $this->suratPerintahKerjaRepository->create($input);

        return $this->sendResponse($suratPerintahKerjas->toArray(), 'Surat Perintah Kerja saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/suratPerintahKerjas/{id}",
     *      summary="Display the specified SuratPerintahKerja",
     *      tags={"SuratPerintahKerja"},
     *      description="Get SuratPerintahKerja",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SuratPerintahKerja",
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
     *                  ref="#/definitions/SuratPerintahKerja"
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
        /** @var SuratPerintahKerja $suratPerintahKerja */
        $suratPerintahKerja = $this->suratPerintahKerjaRepository->findWithoutFail($id);

        if (empty($suratPerintahKerja)) {
            return $this->sendError('Surat Perintah Kerja not found');
        }

        return $this->sendResponse($suratPerintahKerja->toArray(), 'Surat Perintah Kerja retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateSuratPerintahKerjaAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/suratPerintahKerjas/{id}",
     *      summary="Update the specified SuratPerintahKerja in storage",
     *      tags={"SuratPerintahKerja"},
     *      description="Update SuratPerintahKerja",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SuratPerintahKerja",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="SuratPerintahKerja that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SuratPerintahKerja")
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
     *                  ref="#/definitions/SuratPerintahKerja"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSuratPerintahKerjaAPIRequest $request)
    {
        $input = $request->all();

        /** @var SuratPerintahKerja $suratPerintahKerja */
        $suratPerintahKerja = $this->suratPerintahKerjaRepository->findWithoutFail($id);

        if (empty($suratPerintahKerja)) {
            return $this->sendError('Surat Perintah Kerja not found');
        }

        $suratPerintahKerja = $this->suratPerintahKerjaRepository->update($input, $id);

        return $this->sendResponse($suratPerintahKerja->toArray(), 'SuratPerintahKerja updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/suratPerintahKerjas/{id}",
     *      summary="Remove the specified SuratPerintahKerja from storage",
     *      tags={"SuratPerintahKerja"},
     *      description="Delete SuratPerintahKerja",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SuratPerintahKerja",
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
        /** @var SuratPerintahKerja $suratPerintahKerja */
        $suratPerintahKerja = $this->suratPerintahKerjaRepository->findWithoutFail($id);

        if (empty($suratPerintahKerja)) {
            return $this->sendError('Surat Perintah Kerja not found');
        }

        $suratPerintahKerja->delete();

        return $this->sendResponse($id, 'Surat Perintah Kerja deleted successfully');
    }
}
