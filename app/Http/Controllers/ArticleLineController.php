<?php

namespace App\Http\Controllers;

use App\DataTables\ArticleLineDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateArticleLineRequest;
use App\Http\Requests\UpdateArticleLineRequest;
use App\Repositories\ArticleLineRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy

class ArticleLineController extends AppBaseController
{
    /** @var  ArticleLineRepository */
    private $articleLineRepository;

    public function __construct(ArticleLineRepository $articleLineRepo)
    {
        $this->middleware('auth');
        $this->articleLineRepository = $articleLineRepo;
    }

    /**
     * Display a listing of the ArticleLine.
     *
     * @param ArticleLineDataTable $articleLineDataTable
     * @return Response
     */
    public function index(ArticleLineDataTable $articleLineDataTable)
    {
        return $articleLineDataTable->render('article_lines.index');
    }

    /**
     * Show the form for creating a new ArticleLine.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        

        // edited by dandisy
        // return view('article_lines.create');
        return view('article_lines.create');
    }

    /**
     * Store a newly created ArticleLine in storage.
     *
     * @param CreateArticleLineRequest $request
     *
     * @return Response
     */
    public function store(CreateArticleLineRequest $request)
    {
        $input = $request->all();

        $articleLine = $this->articleLineRepository->create($input);

        Flash::success('Article Line saved successfully.');

        return redirect(route('articleLines.index'));
    }

    /**
     * Display the specified ArticleLine.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $articleLine = $this->articleLineRepository->findWithoutFail($id);

        if (empty($articleLine)) {
            Flash::error('Article Line not found');

            return redirect(route('articleLines.index'));
        }

        return view('article_lines.show')->with('articleLine', $articleLine);
    }

    /**
     * Show the form for editing the specified ArticleLine.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        

        $articleLine = $this->articleLineRepository->findWithoutFail($id);

        if (empty($articleLine)) {
            Flash::error('Article Line not found');

            return redirect(route('articleLines.index'));
        }

        // edited by dandisy
        // return view('article_lines.edit')->with('articleLine', $articleLine);
        return view('article_lines.edit')
            ->with('articleLine', $articleLine);        
    }

    /**
     * Update the specified ArticleLine in storage.
     *
     * @param  int              $id
     * @param UpdateArticleLineRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateArticleLineRequest $request)
    {
        $articleLine = $this->articleLineRepository->findWithoutFail($id);

        if (empty($articleLine)) {
            Flash::error('Article Line not found');

            return redirect(route('articleLines.index'));
        }

        $articleLine = $this->articleLineRepository->update($request->all(), $id);

        Flash::success('Article Line updated successfully.');

        return redirect(route('articleLines.index'));
    }

    /**
     * Remove the specified ArticleLine from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $articleLine = $this->articleLineRepository->findWithoutFail($id);

        if (empty($articleLine)) {
            Flash::error('Article Line not found');

            return redirect(route('articleLines.index'));
        }

        $this->articleLineRepository->delete($id);

        Flash::success('Article Line deleted successfully.');

        return redirect(route('articleLines.index'));
    }

    /**
     * Store data ArticleLine from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $articleLine = $this->articleLineRepository->create($item->toArray());
            });
        });

        Flash::success('Article Line saved successfully.');

        return redirect(route('articleLines.index'));
    }
}
