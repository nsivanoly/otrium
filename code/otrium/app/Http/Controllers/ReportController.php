<?php

namespace App\Http\Controllers;

use App\Services\ReportService;
use App\Http\Requests\ReportRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Throwable;

/**
 * Class ReportController
 * @package App\Http\Controllers
 */
class ReportController extends Controller
{
    /**
     * @var ReportService
     */
    protected $reportService;

    /**
     * @var array
     */
    protected $dateRange;

    /**
     * ReportController constructor.
     * @param ReportService $reportService
     */
    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
        $this->dateRange = range(1, 7);
    }

    /**
     * Load landing page
     * @return Factory|View
     */
    public function index()
    {
        return view('index');
    }


    /**
     * @param ReportRequest $request
     * @return RedirectResponse|mixed
     */
    public function export(ReportRequest $request)
    {
        $selectedYear = $request['year'];
        $selectedMonth = $request['month'];

        $res = $this->reportService->makeCsv($selectedYear, $selectedMonth, $this->dateRange);

        if (!$res) {
            return Redirect::back()->withErrors(["<strong>Sorry!</strong> No records found."]);
        }

        return $res;
    }


    /**
     * @param ReportRequest $request
     * @return array|string
     * @throws Throwable
     */
    public function displayTable(ReportRequest $request)
    {
        $selectedYear = $request['year'];
        $selectedMonth = $request['month'];
        $range = $this->dateRange;

        $monthName = $this->reportService->getMonthName($selectedYear, $selectedMonth);

        $data = $this->reportService->getReportData($selectedYear, $selectedMonth, $range);

        if ($data) {
            return view("partial.table", compact('data', 'range', 'monthName'))->render();
        } else {
            return view("partial.no_data");
        }
    }
}
