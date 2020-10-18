<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AuthByCookie;
use App\Http\Requests\StoreStudentRequest;
use App\Models\Student;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    private const SEARCH_COLS = ["name", "surname", "group", "points"];
    private const STUDENTS_PER_PAGE = 10;


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
        $search = $request->input("search");
        $sort_by = $request->input("sort_by");
        $sort_order = $request->input("sort_order");

        $uri_parameters = $this->getUriParameters($sort_by, $sort_order, $search);

        if (!in_array($sort_by, self::SEARCH_COLS))
            $sort_by = "id";
        if (empty($sort_order))
            $sort_order = "asc";

        $students = $this->getStudents($sort_by, $sort_order, $search);

        return view("pages.list")->with([
            "search" => $request->input("search"),
            "cols_data" => $this->getSortData($request),
            "students" => $students,
            "pagination_html" => $students->appends($uri_parameters)->links(),
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @return View
     */
    public function show()
    {
        return view("pages.edit")->with([
            "student" => session("student", null)
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param StoreStudentRequest $request
     * @param Student $student
     * @return RedirectResponse
     */
    public function update(StoreStudentRequest $request, Student $student)
    {
        $validated_data = $request->validated();

        $student = Student::where("token", $request->cookie("token"))->firstOrFail();
        $student->update($validated_data);
        $student->save();

        $student->saveInSession();

        return redirect()->route("list");
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param StoreStudentRequest $request
     * @return RedirectResponse
     */
    public function store(StoreStudentRequest $request)
    {
        $validated_data = $request->validated();

        $student = new Student($validated_data);
        $student->token = $token = Str::random(60);
        $student->save();

        return redirect()->route("list")->withCookie(
                cookie()->forever("token", $token));
    }


    /**
     * Get array of sort data
     *
     * @param Request $request
     * @return array
     */
    private function getSortData(Request $request): array
    {
        $arr = [];
        $current_sort_col = $request->input("sort_by");
        $current_sort_order = $request->input("sort_order");

        foreach (self::SEARCH_COLS as $col) {
            $current = ($col === $current_sort_col);
            $arr[$col]["current"] = $current;
            if ($current) {
                $new_sort_order = $current_sort_order !== "asc" ? "asc" : "desc";
                $arr[$col]["url"] = $request->fullUrlWithQuery([
                    "sort_by" => $col,
                    "sort_order" => $new_sort_order
                ]);
                $arr[$col]["sort_order"] = $new_sort_order;
            } else
                $arr[$col]["url"] = $request->fullUrlWithQuery([
                    "sort_by" => $col,
                    "sort_order" => "asc"
                ]);
        }

        return $arr;
    }


    /**
     * @param string $sort_by
     * @param string $sort_order
     * @param string|null $search
     * @return Paginator
     */
    private function getStudents(string $sort_by, string $sort_order, ?string $search)
    {
        $query = Student::orderBy($sort_by, $sort_order);

        if (!empty($search)) {
            for ($i = 0; $i < count(self::SEARCH_COLS); $i++) if ($i === 0)
                $query = $query->where(self::SEARCH_COLS[0], "like", "%$search%");
            else
                $query->orWhere(self::SEARCH_COLS[$i], "like", "%$search%");
        }

        return $query->paginate(self::STUDENTS_PER_PAGE);
    }


    /**
     * @param string|null $sort_by
     * @param string|null $sort_order
     * @param string|null $search
     * @return array
     */
    private function getUriParameters(?string $sort_by, ?string $sort_order, ?string $search)
    {
        $uri_parameters = [];
        if (!empty($search))
            $uri_parameters["search"] = $search;
        if (!empty($sort_by))
            $uri_parameters["sort_by"] = $sort_by;
        if (!empty($sort_order))
            $uri_parameters["sort_order"] = $sort_order;

        return $uri_parameters;
    }
}
