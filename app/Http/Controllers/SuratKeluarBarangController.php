<?php

namespace App\Http\Controllers;

use App\DataTables\SuratKeluarBarangDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateSuratKeluarBarangRequest;
use App\Http\Requests\UpdateSuratKeluarBarangRequest;
use App\Repositories\SuratKeluarBarangRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy

class SuratKeluarBarangController extends AppBaseController
{
    /** @var  SuratKeluarBarangRepository */
    private $suratKeluarBarangRepository;

    public function __construct(SuratKeluarBarangRepository $suratKeluarBarangRepo)
    {
        $this->middleware('auth');
        $this->suratKeluarBarangRepository = $suratKeluarBarangRepo;
    }

    /**
     * Display a listing of the SuratKeluarBarang.
     *
     * @param SuratKeluarBarangDataTable $suratKeluarBarangDataTable
     * @return Response
     */
    public function index(SuratKeluarBarangDataTable $suratKeluarBarangDataTable)
    {
        return $suratKeluarBarangDataTable->render('surat_keluar_barangs.index');
    }

    /**
     * Show the form for creating a new SuratKeluarBarang.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        

        // edited by dandisy
        // return view('surat_keluar_barangs.create');
        return view('surat_keluar_barangs.create');
    }

    /**
     * Store a newly created SuratKeluarBarang in storage.
     *
     * @param CreateSuratKeluarBarangRequest $request
     *
     * @return Response
     */
    public function store(CreateSuratKeluarBarangRequest $request)
    {
        $input = $request->all();

        $suratKeluarBarang = $this->suratKeluarBarangRepository->create($input);

        Flash::success('Surat Keluar Barang saved successfully.');

        return redirect(route('suratKeluarBarangs.index'));
    }

    /**
     * Display the specified SuratKeluarBarang.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $suratKeluarBarang = $this->suratKeluarBarangRepository->findWithoutFail($id);

        if (empty($suratKeluarBarang)) {
            Flash::error('Surat Keluar Barang not found');

            return redirect(route('suratKeluarBarangs.index'));
        }

        return view('surat_keluar_barangs.show')->with('suratKeluarBarang', $suratKeluarBarang);
    }

    /**
     * Show the form for editing the specified SuratKeluarBarang.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        

        $suratKeluarBarang = $this->suratKeluarBarangRepository->findWithoutFail($id);

        if (empty($suratKeluarBarang)) {
            Flash::error('Surat Keluar Barang not found');

            return redirect(route('suratKeluarBarangs.index'));
        }

        // edited by dandisy
        // return view('surat_keluar_barangs.edit')->with('suratKeluarBarang', $suratKeluarBarang);
        return view('surat_keluar_barangs.edit')
            ->with('suratKeluarBarang', $suratKeluarBarang);        
    }

    /**
     * Update the specified SuratKeluarBarang in storage.
     *
     * @param  int              $id
     * @param UpdateSuratKeluarBarangRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSuratKeluarBarangRequest $request)
    {
        $suratKeluarBarang = $this->suratKeluarBarangRepository->findWithoutFail($id);

        if (empty($suratKeluarBarang)) {
            Flash::error('Surat Keluar Barang not found');

            return redirect(route('suratKeluarBarangs.index'));
        }

        $suratKeluarBarang = $this->suratKeluarBarangRepository->update($request->all(), $id);

        Flash::success('Surat Keluar Barang updated successfully.');

        return redirect(route('suratKeluarBarangs.index'));
    }

    /**
     * Remove the specified SuratKeluarBarang from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $suratKeluarBarang = $this->suratKeluarBarangRepository->findWithoutFail($id);

        if (empty($suratKeluarBarang)) {
            Flash::error('Surat Keluar Barang not found');

            return redirect(route('suratKeluarBarangs.index'));
        }

        $this->suratKeluarBarangRepository->delete($id);

        Flash::success('Surat Keluar Barang deleted successfully.');

        return redirect(route('suratKeluarBarangs.index'));
    }

    /**
     * Store data SuratKeluarBarang from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $suratKeluarBarang = $this->suratKeluarBarangRepository->create($item->toArray());
            });
        });

        Flash::success('Surat Keluar Barang saved successfully.');

        return redirect(route('suratKeluarBarangs.index'));
    }
}
