<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSuratKeluarBarangLineAPIRequest;
use App\Http\Requests\API\UpdateSuratKeluarBarangLineAPIRequest;
use App\Models\SuratKeluarBarangLine;
use App\Repositories\SuratKeluarBarangLineRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class SuratKeluarBarangLineController
 * @package App\Http\Controllers\API
 */

class SuratKeluarBarangLineAPIController extends AppBaseController
{
    /** @var  SuratKeluarBarangLineRepository */
    private $suratKeluarBarangLineRepository;

    public function __construct(SuratKeluarBarangLineRepository $suratKeluarBarangLineRepo)
    {
        $this->middleware('auth:api');
        $this->suratKeluarBarangLineRepository = $suratKeluarBarangLineRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/suratKeluarBarangLines",
     *      summary="Get a listing of the SuratKeluarBarangLines.",
     *      tags={"SuratKeluarBarangLine"},
     *      description="Get all SuratKeluarBarangLines",
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
     *                  @SWG\Items(ref="#/definitions/SuratKeluarBarangLine")
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
        $this->suratKeluarBarangLineRepository->pushCriteria(new RequestCriteria($request));
        $this->suratKeluarBarangLineRepository->pushCriteria(new LimitOffsetCriteria($request));
        $suratKeluarBarangLines = $this->suratKeluarBarangLineRepository->all();

        return $this->sendResponse($suratKeluarBarangLines->toArray(), 'Surat Keluar Barang Lines retrieved successfully');
    }

    /**
     * @param CreateSuratKeluarBarangLineAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/suratKeluarBarangLines",
     *      summary="Store a newly created SuratKeluarBarangLine in storage",
     *      tags={"SuratKeluarBarangLine"},
     *      description="Store SuratKeluarBarangLine",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="SuratKeluarBarangLine that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SuratKeluarBarangLine")
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
     *                  ref="#/definitions/SuratKeluarBarangLine"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSuratKeluarBarangLineAPIRequest $request)
    {
        $input = $request->all();

        $suratKeluarBarangLines = $this->suratKeluarBarangLineRepository->create($input);

        return $this->sendResponse($suratKeluarBarangLines->toArray(), 'Surat Keluar Barang Line saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/suratKeluarBarangLines/{id}",
     *      summary="Display the specified SuratKeluarBarangLine",
     *      tags={"SuratKeluarBarangLine"},
     *      description="Get SuratKeluarBarangLine",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SuratKeluarBarangLine",
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
     *                  ref="#/definitions/SuratKeluarBarangLine"
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
        /** @var SuratKeluarBarangLine $suratKeluarBarangLine */
        $suratKeluarBarangLine = $this->suratKeluarBarangLineRepository->findWithoutFail($id);

        if (empty($suratKeluarBarangLine)) {
            return $this->sendError('Surat Keluar Barang Line not found');
        }

        return $this->sendResponse($suratKeluarBarangLine->toArray(), 'Surat Keluar Barang Line retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateSuratKeluarBarangLineAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/suratKeluarBarangLines/{id}",
     *      summary="Update the specified SuratKeluarBarangLine in storage",
     *      tags={"SuratKeluarBarangLine"},
     *      description="Update SuratKeluarBarangLine",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SuratKeluarBarangLine",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="SuratKeluarBarangLine that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SuratKeluarBarangLine")
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
     *                  ref="#/definitions/SuratKeluarBarangLine"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSuratKeluarBarangLineAPIRequest $request)
    {
        $input = $request->all();

        /** @var SuratKeluarBarangLine $suratKeluarBarangLine */
        $suratKeluarBarangLine = $this->suratKeluarBarangLineRepository->findWithoutFail($id);

        if (empty($suratKeluarBarangLine)) {
            return $this->sendError('Surat Keluar Barang Line not found');
        }

        $suratKeluarBarangLine = $this->suratKeluarBarangLineRepository->update($input, $id);

        return $this->sendResponse($suratKeluarBarangLine->toArray(), 'SuratKeluarBarangLine updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/suratKeluarBarangLines/{id}",
     *      summary="Remove the specified SuratKeluarBarangLine from storage",
     *      tags={"SuratKeluarBarangLine"},
     *      description="Delete SuratKeluarBarangLine",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SuratKeluarBarangLine",
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
        /** @var SuratKeluarBarangLine $suratKeluarBarangLine */
        $suratKeluarBarangLine = $this->suratKeluarBarangLineRepository->findWithoutFail($id);

        if (empty($suratKeluarBarangLine)) {
            return $this->sendError('Surat Keluar Barang Line not found');
        }

        $suratKeluarBarangLine->delete();

        return $this->sendResponse($id, 'Surat Keluar Barang Line deleted successfully');
    }
}
