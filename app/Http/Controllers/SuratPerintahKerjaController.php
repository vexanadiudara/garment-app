<?php

namespace App\Http\Controllers;

use App\DataTables\SuratPerintahKerjaDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateSuratPerintahKerjaRequest;
use App\Http\Requests\UpdateSuratPerintahKerjaRequest;
use App\Repositories\SuratPerintahKerjaRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy

class SuratPerintahKerjaController extends AppBaseController
{
    /** @var  SuratPerintahKerjaRepository */
    private $suratPerintahKerjaRepository;

    public function __construct(SuratPerintahKerjaRepository $suratPerintahKerjaRepo)
    {
        $this->middleware('auth');
        $this->suratPerintahKerjaRepository = $suratPerintahKerjaRepo;
    }

    /**
     * Display a listing of the SuratPerintahKerja.
     *
     * @param SuratPerintahKerjaDataTable $suratPerintahKerjaDataTable
     * @return Response
     */
    public function index(SuratPerintahKerjaDataTable $suratPerintahKerjaDataTable)
    {
        return $suratPerintahKerjaDataTable->render('surat_perintah_kerjas.index');
    }

    /**
     * Show the form for creating a new SuratPerintahKerja.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        

        // edited by dandisy
        // return view('surat_perintah_kerjas.create');
        return view('surat_perintah_kerjas.create');
    }

    /**
     * Store a newly created SuratPerintahKerja in storage.
     *
     * @param CreateSuratPerintahKerjaRequest $request
     *
     * @return Response
     */
    public function store(CreateSuratPerintahKerjaRequest $request)
    {
        $input = $request->all();

        $suratPerintahKerja = $this->suratPerintahKerjaRepository->create($input);

        Flash::success('Surat Perintah Kerja saved successfully.');

        return redirect(route('suratPerintahKerjas.index'));
    }

    /**
     * Display the specified SuratPerintahKerja.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $suratPerintahKerja = $this->suratPerintahKerjaRepository->findWithoutFail($id);

        if (empty($suratPerintahKerja)) {
            Flash::error('Surat Perintah Kerja not found');

            return redirect(route('suratPerintahKerjas.index'));
        }

        return view('surat_perintah_kerjas.show')->with('suratPerintahKerja', $suratPerintahKerja);
    }

    /**
     * Show the form for editing the specified SuratPerintahKerja.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        

        $suratPerintahKerja = $this->suratPerintahKerjaRepository->findWithoutFail($id);

        if (empty($suratPerintahKerja)) {
            Flash::error('Surat Perintah Kerja not found');

            return redirect(route('suratPerintahKerjas.index'));
        }

        // edited by dandisy
        // return view('surat_perintah_kerjas.edit')->with('suratPerintahKerja', $suratPerintahKerja);
        return view('surat_perintah_kerjas.edit')
            ->with('suratPerintahKerja', $suratPerintahKerja);        
    }

    /**
     * Update the specified SuratPerintahKerja in storage.
     *
     * @param  int              $id
     * @param UpdateSuratPerintahKerjaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSuratPerintahKerjaRequest $request)
    {
        $suratPerintahKerja = $this->suratPerintahKerjaRepository->findWithoutFail($id);

        if (empty($suratPerintahKerja)) {
            Flash::error('Surat Perintah Kerja not found');

            return redirect(route('suratPerintahKerjas.index'));
        }

        $suratPerintahKerja = $this->suratPerintahKerjaRepository->update($request->all(), $id);

        Flash::success('Surat Perintah Kerja updated successfully.');

        return redirect(route('suratPerintahKerjas.index'));
    }

    /**
     * Remove the specified SuratPerintahKerja from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $suratPerintahKerja = $this->suratPerintahKerjaRepository->findWithoutFail($id);

        if (empty($suratPerintahKerja)) {
            Flash::error('Surat Perintah Kerja not found');

            return redirect(route('suratPerintahKerjas.index'));
        }

        $this->suratPerintahKerjaRepository->delete($id);

        Flash::success('Surat Perintah Kerja deleted successfully.');

        return redirect(route('suratPerintahKerjas.index'));
    }

    /**
     * Store data SuratPerintahKerja from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $suratPerintahKerja = $this->suratPerintahKerjaRepository->create($item->toArray());
            });
        });

        Flash::success('Surat Perintah Kerja saved successfully.');

        return redirect(route('suratPerintahKerjas.index'));
    }
}
