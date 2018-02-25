<?php

namespace App\Http\Controllers;

use App\Service\ArticleService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /** @var ArticleService $articleService */
    private $articleService;

    /**
     * ArticleController constructor.
     * @param ArticleService $articleService ArticleService を DI
     */
    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request Request を DI
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $params   = $request->only('start');
        $articles = $this->articleService->paginate((int)array_get($params, 'start', 1));

        return view('admin.article.index', compact('articles'));
    }
}
