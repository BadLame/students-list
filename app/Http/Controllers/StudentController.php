<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AuthByCookie;
use App\Models\Student;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StudentController extends Controller
{
    private const SEARCH_COLS = ["name", "surname", "group", "points"];

    public function __construct()
    {
        $this->middleware(AuthByCookie::class);
    }

    /**
     * Display a list of students
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        $url_parameters = [];

        $search = $request->input("search");
        $sort_by = $request->input("sort_by");
        $sort_order = $request->input("sort_order");

        if (!empty($search))
            $url_parameters["search"] = $search;
        if (!empty($sort_by))
            $url_parameters["sort_by"] = $sort_by;
        if (!empty($sort_order))
            $url_parameters["sort_order"] = $sort_order;

        if (!in_array($sort_by, self::SEARCH_COLS))
            $sort_by = "id";
        if (empty($sort_order))
            $sort_order = "asc";

        $query = Student::orderBy($sort_by, $sort_order);

        if (!empty($search))
        {
            for ($i = 0; $i < count(self::SEARCH_COLS); $i++) if ($i === 0)
                $query = $query->where(self::SEARCH_COLS[0], "like", "%$search%");
            else
                $query->orWhere(self::SEARCH_COLS[$i], "like", "%$search%");
        }

        $students = $query->paginate(Student::PER_PAGE);

        return view("pages.list")->with([
            "search" => $request->input("search"),
            "students" => $students,
            "request" => $request,
            "pagination" => $students->appends($url_parameters)->links(),
            "sort_links" => $this->getSortLinks($request),
        ]);
    }


    /**
     *
     *
     * @param Request $request
     * @return array
     */
    private function getSortLinks(Request $request) : array
    {
        $arr = [];
        $current_sort_col = $request->input("sort_by");
        $current_sort_order = $request->input("sort_order");

        foreach (self::SEARCH_COLS as $col) {
            $current = $col === $current_sort_col;
            $arr[$col]["current"] = $current;
            if ($current)
                $arr[$col]["url"] = $request->fullUrlWithQuery([
                    "sort_by" => $col,
                    "sort_order" => $current_sort_order !== "asc" ? "asc" : "desc"
                ]);
            else
                $arr[$col]["url"] = $request->fullUrlWithQuery(["sort_by" => $col]);
        }

        return $arr;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @return View
     */
    public function show()
    {
        if (session()->get("authenticated"))
            return view("pages.edit")->with([
                "student" => session()->get("student")
            ]);
        else
            return view("pages.edit");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Student $student
     * @return Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Student $student
     * @return Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }
}
