<?php

namespace App\Http\Controllers;

use App\DataTables\OperatorGosokDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateOperatorGosokRequest;
use App\Http\Requests\UpdateOperatorGosokRequest;
use App\Repositories\OperatorGosokRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy

class OperatorGosokController extends AppBaseController
{
    /** @var  OperatorGosokRepository */
    private $operatorGosokRepository;

    public function __construct(OperatorGosokRepository $operatorGosokRepo)
    {
        $this->middleware('auth');
        $this->operatorGosokRepository = $operatorGosokRepo;
    }

    /**
     * Display a listing of the OperatorGosok.
     *
     * @param OperatorGosokDataTable $operatorGosokDataTable
     * @return Response
     */
    public function index(OperatorGosokDataTable $operatorGosokDataTable)
    {
        return $operatorGosokDataTable->render('operator_gosoks.index');
    }

    /**
     * Show the form for creating a new OperatorGosok.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        

        // edited by dandisy
        // return view('operator_gosoks.create');
        return view('operator_gosoks.create');
    }

    /**
     * Store a newly created OperatorGosok in storage.
     *
     * @param CreateOperatorGosokRequest $request
     *
     * @return Response
     */
    public function store(CreateOperatorGosokRequest $request)
    {
        $input = $request->all();

        $operatorGosok = $this->operatorGosokRepository->create($input);

        Flash::success('Operator Gosok saved successfully.');

        return redirect(route('operatorGosoks.index'));
    }

    /**
     * Display the specified OperatorGosok.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $operatorGosok = $this->operatorGosokRepository->findWithoutFail($id);

        if (empty($operatorGosok)) {
            Flash::error('Operator Gosok not found');

            return redirect(route('operatorGosoks.index'));
        }

        return view('operator_gosoks.show')->with('operatorGosok', $operatorGosok);
    }

    /**
     * Show the form for editing the specified OperatorGosok.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        

        $operatorGosok = $this->operatorGosokRepository->findWithoutFail($id);

        if (empty($operatorGosok)) {
            Flash::error('Operator Gosok not found');

            return redirect(route('operatorGosoks.index'));
        }

        // edited by dandisy
        // return view('operator_gosoks.edit')->with('operatorGosok', $operatorGosok);
        return view('operator_gosoks.edit')
            ->with('operatorGosok', $operatorGosok);        
    }

    /**
     * Update the specified OperatorGosok in storage.
     *
     * @param  int              $id
     * @param UpdateOperatorGosokRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOperatorGosokRequest $request)
    {
        $operatorGosok = $this->operatorGosokRepository->findWithoutFail($id);

        if (empty($operatorGosok)) {
            Flash::error('Operator Gosok not found');

            return redirect(route('operatorGosoks.index'));
        }

        $operatorGosok = $this->operatorGosokRepository->update($request->all(), $id);

        Flash::success('Operator Gosok updated successfully.');

        return redirect(route('operatorGosoks.index'));
    }

    /**
     * Remove the specified OperatorGosok from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $operatorGosok = $this->operatorGosokRepository->findWithoutFail($id);

        if (empty($operatorGosok)) {
            Flash::error('Operator Gosok not found');

            return redirect(route('operatorGosoks.index'));
        }

        $this->operatorGosokRepository->delete($id);

        Flash::success('Operator Gosok deleted successfully.');

        return redirect(route('operatorGosoks.index'));
    }

    /**
     * Store data OperatorGosok from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $operatorGosok = $this->operatorGosokRepository->create($item->toArray());
            });
        });

        Flash::success('Operator Gosok saved successfully.');

        return redirect(route('operatorGosoks.index'));
    }
}
