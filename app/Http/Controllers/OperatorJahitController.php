<?php

namespace App\Http\Controllers;

use App\DataTables\OperatorJahitDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateOperatorJahitRequest;
use App\Http\Requests\UpdateOperatorJahitRequest;
use App\Repositories\OperatorJahitRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy

class OperatorJahitController extends AppBaseController
{
    /** @var  OperatorJahitRepository */
    private $operatorJahitRepository;

    public function __construct(OperatorJahitRepository $operatorJahitRepo)
    {
        $this->middleware('auth');
        $this->operatorJahitRepository = $operatorJahitRepo;
    }

    /**
     * Display a listing of the OperatorJahit.
     *
     * @param OperatorJahitDataTable $operatorJahitDataTable
     * @return Response
     */
    public function index(OperatorJahitDataTable $operatorJahitDataTable)
    {
        return $operatorJahitDataTable->render('operator_jahits.index');
    }

    /**
     * Show the form for creating a new OperatorJahit.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        

        // edited by dandisy
        // return view('operator_jahits.create');
        return view('operator_jahits.create');
    }

    /**
     * Store a newly created OperatorJahit in storage.
     *
     * @param CreateOperatorJahitRequest $request
     *
     * @return Response
     */
    public function store(CreateOperatorJahitRequest $request)
    {
        $input = $request->all();

        $operatorJahit = $this->operatorJahitRepository->create($input);

        Flash::success('Operator Jahit saved successfully.');

        return redirect(route('operatorJahits.index'));
    }

    /**
     * Display the specified OperatorJahit.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $operatorJahit = $this->operatorJahitRepository->findWithoutFail($id);

        if (empty($operatorJahit)) {
            Flash::error('Operator Jahit not found');

            return redirect(route('operatorJahits.index'));
        }

        return view('operator_jahits.show')->with('operatorJahit', $operatorJahit);
    }

    /**
     * Show the form for editing the specified OperatorJahit.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        

        $operatorJahit = $this->operatorJahitRepository->findWithoutFail($id);

        if (empty($operatorJahit)) {
            Flash::error('Operator Jahit not found');

            return redirect(route('operatorJahits.index'));
        }

        // edited by dandisy
        // return view('operator_jahits.edit')->with('operatorJahit', $operatorJahit);
        return view('operator_jahits.edit')
            ->with('operatorJahit', $operatorJahit);        
    }

    /**
     * Update the specified OperatorJahit in storage.
     *
     * @param  int              $id
     * @param UpdateOperatorJahitRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOperatorJahitRequest $request)
    {
        $operatorJahit = $this->operatorJahitRepository->findWithoutFail($id);

        if (empty($operatorJahit)) {
            Flash::error('Operator Jahit not found');

            return redirect(route('operatorJahits.index'));
        }

        $operatorJahit = $this->operatorJahitRepository->update($request->all(), $id);

        Flash::success('Operator Jahit updated successfully.');

        return redirect(route('operatorJahits.index'));
    }

    /**
     * Remove the specified OperatorJahit from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $operatorJahit = $this->operatorJahitRepository->findWithoutFail($id);

        if (empty($operatorJahit)) {
            Flash::error('Operator Jahit not found');

            return redirect(route('operatorJahits.index'));
        }

        $this->operatorJahitRepository->delete($id);

        Flash::success('Operator Jahit deleted successfully.');

        return redirect(route('operatorJahits.index'));
    }

    /**
     * Store data OperatorJahit from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $operatorJahit = $this->operatorJahitRepository->create($item->toArray());
            });
        });

        Flash::success('Operator Jahit saved successfully.');

        return redirect(route('operatorJahits.index'));
    }
}
