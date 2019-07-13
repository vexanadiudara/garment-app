<?php

namespace App\Http\Controllers;

use App\DataTables\OperatorBuangBenangDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateOperatorBuangBenangRequest;
use App\Http\Requests\UpdateOperatorBuangBenangRequest;
use App\Repositories\OperatorBuangBenangRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy

class OperatorBuangBenangController extends AppBaseController
{
    /** @var  OperatorBuangBenangRepository */
    private $operatorBuangBenangRepository;

    public function __construct(OperatorBuangBenangRepository $operatorBuangBenangRepo)
    {
        $this->middleware('auth');
        $this->operatorBuangBenangRepository = $operatorBuangBenangRepo;
    }

    /**
     * Display a listing of the OperatorBuangBenang.
     *
     * @param OperatorBuangBenangDataTable $operatorBuangBenangDataTable
     * @return Response
     */
    public function index(OperatorBuangBenangDataTable $operatorBuangBenangDataTable)
    {
        return $operatorBuangBenangDataTable->render('operator_buang_benangs.index');
    }

    /**
     * Show the form for creating a new OperatorBuangBenang.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        

        // edited by dandisy
        // return view('operator_buang_benangs.create');
        return view('operator_buang_benangs.create');
    }

    /**
     * Store a newly created OperatorBuangBenang in storage.
     *
     * @param CreateOperatorBuangBenangRequest $request
     *
     * @return Response
     */
    public function store(CreateOperatorBuangBenangRequest $request)
    {
        $input = $request->all();

        $operatorBuangBenang = $this->operatorBuangBenangRepository->create($input);

        Flash::success('Operator Buang Benang saved successfully.');

        return redirect(route('operatorBuangBenangs.index'));
    }

    /**
     * Display the specified OperatorBuangBenang.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $operatorBuangBenang = $this->operatorBuangBenangRepository->findWithoutFail($id);

        if (empty($operatorBuangBenang)) {
            Flash::error('Operator Buang Benang not found');

            return redirect(route('operatorBuangBenangs.index'));
        }

        return view('operator_buang_benangs.show')->with('operatorBuangBenang', $operatorBuangBenang);
    }

    /**
     * Show the form for editing the specified OperatorBuangBenang.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        

        $operatorBuangBenang = $this->operatorBuangBenangRepository->findWithoutFail($id);

        if (empty($operatorBuangBenang)) {
            Flash::error('Operator Buang Benang not found');

            return redirect(route('operatorBuangBenangs.index'));
        }

        // edited by dandisy
        // return view('operator_buang_benangs.edit')->with('operatorBuangBenang', $operatorBuangBenang);
        return view('operator_buang_benangs.edit')
            ->with('operatorBuangBenang', $operatorBuangBenang);        
    }

    /**
     * Update the specified OperatorBuangBenang in storage.
     *
     * @param  int              $id
     * @param UpdateOperatorBuangBenangRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOperatorBuangBenangRequest $request)
    {
        $operatorBuangBenang = $this->operatorBuangBenangRepository->findWithoutFail($id);

        if (empty($operatorBuangBenang)) {
            Flash::error('Operator Buang Benang not found');

            return redirect(route('operatorBuangBenangs.index'));
        }

        $operatorBuangBenang = $this->operatorBuangBenangRepository->update($request->all(), $id);

        Flash::success('Operator Buang Benang updated successfully.');

        return redirect(route('operatorBuangBenangs.index'));
    }

    /**
     * Remove the specified OperatorBuangBenang from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $operatorBuangBenang = $this->operatorBuangBenangRepository->findWithoutFail($id);

        if (empty($operatorBuangBenang)) {
            Flash::error('Operator Buang Benang not found');

            return redirect(route('operatorBuangBenangs.index'));
        }

        $this->operatorBuangBenangRepository->delete($id);

        Flash::success('Operator Buang Benang deleted successfully.');

        return redirect(route('operatorBuangBenangs.index'));
    }

    /**
     * Store data OperatorBuangBenang from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $operatorBuangBenang = $this->operatorBuangBenangRepository->create($item->toArray());
            });
        });

        Flash::success('Operator Buang Benang saved successfully.');

        return redirect(route('operatorBuangBenangs.index'));
    }
}
