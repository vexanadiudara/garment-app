<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSuratKeluarBarangAPIRequest;
use App\Http\Requests\API\UpdateSuratKeluarBarangAPIRequest;
use App\Models\SuratKeluarBarang;
use App\Repositories\SuratKeluarBarangRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class SuratKeluarBarangController
 * @package App\Http\Controllers\API
 */

class SuratKeluarBarangAPIController extends AppBaseController
{
    /** @var  SuratKeluarBarangRepository */
    private $suratKeluarBarangRepository;

    public function __construct(SuratKeluarBarangRepository $suratKeluarBarangRepo)
    {
        $this->middleware('auth:api');
        $this->suratKeluarBarangRepository = $suratKeluarBarangRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/suratKeluarBarangs",
     *      summary="Get a listing of the SuratKeluarBarangs.",
     *      tags={"SuratKeluarBarang"},
     *      description="Get all SuratKeluarBarangs",
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
     *                  @SWG\Items(ref="#/definitions/SuratKeluarBarang")
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
        $this->suratKeluarBarangRepository->pushCriteria(new RequestCriteria($request));
        $this->suratKeluarBarangRepository->pushCriteria(new LimitOffsetCriteria($request));
        $suratKeluarBarangs = $this->suratKeluarBarangRepository->all();

        return $this->sendResponse($suratKeluarBarangs->toArray(), 'Surat Keluar Barangs retrieved successfully');
    }

    /**
     * @param CreateSuratKeluarBarangAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/suratKeluarBarangs",
     *      summary="Store a newly created SuratKeluarBarang in storage",
     *      tags={"SuratKeluarBarang"},
     *      description="Store SuratKeluarBarang",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="SuratKeluarBarang that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SuratKeluarBarang")
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
     *                  ref="#/definitions/SuratKeluarBarang"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSuratKeluarBarangAPIRequest $request)
    {
        $input = $request->all();

        $suratKeluarBarangs = $this->suratKeluarBarangRepository->create($input);

        return $this->sendResponse($suratKeluarBarangs->toArray(), 'Surat Keluar Barang saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/suratKeluarBarangs/{id}",
     *      summary="Display the specified SuratKeluarBarang",
     *      tags={"SuratKeluarBarang"},
     *      description="Get SuratKeluarBarang",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SuratKeluarBarang",
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
     *                  ref="#/definitions/SuratKeluarBarang"
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
        /** @var SuratKeluarBarang $suratKeluarBarang */
        $suratKeluarBarang = $this->suratKeluarBarangRepository->findWithoutFail($id);

        if (empty($suratKeluarBarang)) {
            return $this->sendError('Surat Keluar Barang not found');
        }

        return $this->sendResponse($suratKeluarBarang->toArray(), 'Surat Keluar Barang retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateSuratKeluarBarangAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/suratKeluarBarangs/{id}",
     *      summary="Update the specified SuratKeluarBarang in storage",
     *      tags={"SuratKeluarBarang"},
     *      description="Update SuratKeluarBarang",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SuratKeluarBarang",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="SuratKeluarBarang that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SuratKeluarBarang")
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
     *                  ref="#/definitions/SuratKeluarBarang"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSuratKeluarBarangAPIRequest $request)
    {
        $input = $request->all();

        /** @var SuratKeluarBarang $suratKeluarBarang */
        $suratKeluarBarang = $this->suratKeluarBarangRepository->findWithoutFail($id);

        if (empty($suratKeluarBarang)) {
            return $this->sendError('Surat Keluar Barang not found');
        }

        $suratKeluarBarang = $this->suratKeluarBarangRepository->update($input, $id);

        return $this->sendResponse($suratKeluarBarang->toArray(), 'SuratKeluarBarang updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/suratKeluarBarangs/{id}",
     *      summary="Remove the specified SuratKeluarBarang from storage",
     *      tags={"SuratKeluarBarang"},
     *      description="Delete SuratKeluarBarang",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SuratKeluarBarang",
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
        /** @var SuratKeluarBarang $suratKeluarBarang */
        $suratKeluarBarang = $this->suratKeluarBarangRepository->findWithoutFail($id);

        if (empty($suratKeluarBarang)) {
            return $this->sendError('Surat Keluar Barang not found');
        }

        $suratKeluarBarang->delete();

        return $this->sendResponse($id, 'Surat Keluar Barang deleted successfully');
    }
}
