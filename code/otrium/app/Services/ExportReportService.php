<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * Class ExportReportService
 * @package App\Services
 */
class ExportReportService
{

    /**
     * @param $data
     * @param array $columns
     * @param string $fileName
     * @return StreamedResponse
     */
    public static function exportCsv($data, $columns = [], $fileName = 'file')
    {
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=" . $fileName . ".csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        if (!$columns) {
            $columns = array_keys($data[0]);
        }

        $callback = function () use ($columns, $data) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            foreach ($data as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }
}


