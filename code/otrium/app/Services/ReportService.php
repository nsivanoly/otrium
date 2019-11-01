<?php

namespace App\Services;

use App\Repositories\GmvRepository;
use Carbon\Carbon;

/**
 * Class ReportService
 * @package App\Services
 */
class ReportService
{
    /**
     * @var GmvRepository
     */
    protected $gmvRepository;

    /**
     * TurnoverReportService constructor.
     * @param GmvRepository $gmvRepository
     */
    public function __construct(GmvRepository $gmvRepository)
    {
        $this->gmvRepository = $gmvRepository;
    }

    /**
     * Get report data
     * @param integer $year Year value
     * @param integer $month Month Value
     * @param $range
     * @return array
     */
    public function getReportData($year, $month, $range)
    {
        // Get table data
        $reportData = $this->gmvRepository->getData($year, $month, $range)->toArray();

        // return if null
        if (!$reportData) {
            return null;
        }

        // calculate the total
        $data = $this->formatData($this->calculateTotal($reportData, $range));

        // return
        return $data;
    }

    /**
     * Generate turnover CSV
     * @param integer $year Year value
     * @param integer $month Month Value
     * @param $range
     * @return mixed
     */
    public function makeCsv($year, $month, $range)
    {
        //get report data
        $data = $this->getReportData($year, $month, $range);

        // return if null
        if (!$data) {
            return null;
        }

        $monthName = $this->getMonthName($year, $month);

        $columns = array();
        $columns[] = 'Brand';

        foreach ($range as $day):
            $columns[] = $monthName . ' ' . $day;
        endforeach;

        $columns[] = 'Total [Per Brand]';
        $columns[] = 'Total without VAT 21% [Per Brand]';

        $reportName = 'Report-' . $range[0] . '-to-' . end($range) . '-' . $month . '-' . $year;

        //generate csv
        return ExportReportService::exportCsv($data, $columns, $reportName);
    }

    /**
     * Make pivot array from data
     * @param $reportData
     * @param $range
     * @return array Description array for CSV
     */
    protected function calculateTotal($reportData, $range)
    {
        //make pivot table with total
        $totalsRow['brand'] = 'Total [Per Day]';
        foreach ($reportData as $row) {
            foreach ($range as $i) {
                if (isset($totalsRow['day_' . $i])) {
                    $totalsRow['day_' . $i] += $row['day_' . $i];
                } else {
                    $totalsRow['day_' . $i] = $row['day_' . $i];
                }
            }
            if (isset($totalsRow['total_brand'])) {
                $totalsRow['total_brand'] += $row['total_brand'];
            } else {
                $totalsRow['total_brand'] = $row['total_brand'];
            }

            if (isset($totalsRow['total_vat'])) {
                $totalsRow['total_vat'] += $row['total_vat'];
            } else {
                $totalsRow['total_vat'] = $row['total_vat'];
            }

        }

        // merge with the results
        $reportData[] = $totalsRow;
        return $reportData;
    }

    /**
     * @param $year
     * @param $month
     * @return string
     */
    public function getMonthName($year, $month)
    {
        $month_name = Carbon::create($year, $month)->format('F');
        return $month_name;
    }

    /**
     * @param $data
     * @return array
     */
    private function formatData($data)
    {
        $return = array();

        foreach ($data as $key => $rows) {
            foreach ($rows as $k => $row) {
                $return[$key][$k] = (is_numeric($row)) ? number_format($row, 2) : $row;
            }
        }

        return $return;
    }
}


