<?php

namespace App\Http\Controllers;

use App\DataTables\StepDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateStepRequest;
use App\Http\Requests\UpdateStepRequest;
use App\Repositories\StepRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy

class StepController extends AppBaseController
{
    /** @var  StepRepository */
    private $stepRepository;

    public function __construct(StepRepository $stepRepo)
    {
        $this->middleware('auth');
        $this->stepRepository = $stepRepo;
    }

    /**
     * Display a listing of the Step.
     *
     * @param StepDataTable $stepDataTable
     * @return Response
     */
    public function index(StepDataTable $stepDataTable)
    {
        return $stepDataTable->render('steps.index');
    }

    /**
     * Show the form for creating a new Step.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        

        // edited by dandisy
        // return view('steps.create');
        return view('steps.create');
    }

    /**
     * Store a newly created Step in storage.
     *
     * @param CreateStepRequest $request
     *
     * @return Response
     */
    public function store(CreateStepRequest $request)
    {
        $input = $request->all();

        $step = $this->stepRepository->create($input);

        Flash::success('Step saved successfully.');

        return redirect(route('steps.index'));
    }

    /**
     * Display the specified Step.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $step = $this->stepRepository->findWithoutFail($id);

        if (empty($step)) {
            Flash::error('Step not found');

            return redirect(route('steps.index'));
        }

        return view('steps.show')->with('step', $step);
    }

    /**
     * Show the form for editing the specified Step.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        

        $step = $this->stepRepository->findWithoutFail($id);

        if (empty($step)) {
            Flash::error('Step not found');

            return redirect(route('steps.index'));
        }

        // edited by dandisy
        // return view('steps.edit')->with('step', $step);
        return view('steps.edit')
            ->with('step', $step);        
    }

    /**
     * Update the specified Step in storage.
     *
     * @param  int              $id
     * @param UpdateStepRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStepRequest $request)
    {
        $step = $this->stepRepository->findWithoutFail($id);

        if (empty($step)) {
            Flash::error('Step not found');

            return redirect(route('steps.index'));
        }

        $step = $this->stepRepository->update($request->all(), $id);

        Flash::success('Step updated successfully.');

        return redirect(route('steps.index'));
    }

    /**
     * Remove the specified Step from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $step = $this->stepRepository->findWithoutFail($id);

        if (empty($step)) {
            Flash::error('Step not found');

            return redirect(route('steps.index'));
        }

        $this->stepRepository->delete($id);

        Flash::success('Step deleted successfully.');

        return redirect(route('steps.index'));
    }

    /**
     * Store data Step from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $step = $this->stepRepository->create($item->toArray());
            });
        });

        Flash::success('Step saved successfully.');

        return redirect(route('steps.index'));
    }
}
