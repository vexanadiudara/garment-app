<?php

namespace App\Http\Controllers;

use App\DataTables\SuratKeluarBarangLineDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateSuratKeluarBarangLineRequest;
use App\Http\Requests\UpdateSuratKeluarBarangLineRequest;
use App\Repositories\SuratKeluarBarangLineRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy

class SuratKeluarBarangLineController extends AppBaseController
{
    /** @var  SuratKeluarBarangLineRepository */
    private $suratKeluarBarangLineRepository;

    public function __construct(SuratKeluarBarangLineRepository $suratKeluarBarangLineRepo)
    {
        $this->middleware('auth');
        $this->suratKeluarBarangLineRepository = $suratKeluarBarangLineRepo;
    }

    /**
     * Display a listing of the SuratKeluarBarangLine.
     *
     * @param SuratKeluarBarangLineDataTable $suratKeluarBarangLineDataTable
     * @return Response
     */
    public function index(SuratKeluarBarangLineDataTable $suratKeluarBarangLineDataTable)
    {
        return $suratKeluarBarangLineDataTable->render('surat_keluar_barang_lines.index');
    }

    /**
     * Show the form for creating a new SuratKeluarBarangLine.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        

        // edited by dandisy
        // return view('surat_keluar_barang_lines.create');
        return view('surat_keluar_barang_lines.create');
    }

    /**
     * Store a newly created SuratKeluarBarangLine in storage.
     *
     * @param CreateSuratKeluarBarangLineRequest $request
     *
     * @return Response
     */
    public function store(CreateSuratKeluarBarangLineRequest $request)
    {
        $input = $request->all();

        $suratKeluarBarangLine = $this->suratKeluarBarangLineRepository->create($input);

        Flash::success('Surat Keluar Barang Line saved successfully.');

        return redirect(route('suratKeluarBarangLines.index'));
    }

    /**
     * Display the specified SuratKeluarBarangLine.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $suratKeluarBarangLine = $this->suratKeluarBarangLineRepository->findWithoutFail($id);

        if (empty($suratKeluarBarangLine)) {
            Flash::error('Surat Keluar Barang Line not found');

            return redirect(route('suratKeluarBarangLines.index'));
        }

        return view('surat_keluar_barang_lines.show')->with('suratKeluarBarangLine', $suratKeluarBarangLine);
    }

    /**
     * Show the form for editing the specified SuratKeluarBarangLine.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        

        $suratKeluarBarangLine = $this->suratKeluarBarangLineRepository->findWithoutFail($id);

        if (empty($suratKeluarBarangLine)) {
            Flash::error('Surat Keluar Barang Line not found');

            return redirect(route('suratKeluarBarangLines.index'));
        }

        // edited by dandisy
        // return view('surat_keluar_barang_lines.edit')->with('suratKeluarBarangLine', $suratKeluarBarangLine);
        return view('surat_keluar_barang_lines.edit')
            ->with('suratKeluarBarangLine', $suratKeluarBarangLine);        
    }

    /**
     * Update the specified SuratKeluarBarangLine in storage.
     *
     * @param  int              $id
     * @param UpdateSuratKeluarBarangLineRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSuratKeluarBarangLineRequest $request)
    {
        $suratKeluarBarangLine = $this->suratKeluarBarangLineRepository->findWithoutFail($id);

        if (empty($suratKeluarBarangLine)) {
            Flash::error('Surat Keluar Barang Line not found');

            return redirect(route('suratKeluarBarangLines.index'));
        }

        $suratKeluarBarangLine = $this->suratKeluarBarangLineRepository->update($request->all(), $id);

        Flash::success('Surat Keluar Barang Line updated successfully.');

        return redirect(route('suratKeluarBarangLines.index'));
    }

    /**
     * Remove the specified SuratKeluarBarangLine from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $suratKeluarBarangLine = $this->suratKeluarBarangLineRepository->findWithoutFail($id);

        if (empty($suratKeluarBarangLine)) {
            Flash::error('Surat Keluar Barang Line not found');

            return redirect(route('suratKeluarBarangLines.index'));
        }

        $this->suratKeluarBarangLineRepository->delete($id);

        Flash::success('Surat Keluar Barang Line deleted successfully.');

        return redirect(route('suratKeluarBarangLines.index'));
    }

    /**
     * Store data SuratKeluarBarangLine from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $suratKeluarBarangLine = $this->suratKeluarBarangLineRepository->create($item->toArray());
            });
        });

        Flash::success('Surat Keluar Barang Line saved successfully.');

        return redirect(route('suratKeluarBarangLines.index'));
    }
}
