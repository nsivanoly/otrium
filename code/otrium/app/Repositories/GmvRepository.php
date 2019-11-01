<?php

namespace App\Repositories;

use App\Models\Gmv;
use App\Repositories\Contracts\Repository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

/**
 * Class GmvRepository
 * @package App\Repositories
 */
class GmvRepository implements Repository
{

    /**
     * @var Gmv
     */
    protected $gmv;

    /**
     * GmvRepository constructor.
     * @param Gmv $gmv
     */
    public function __construct(Gmv $gmv)
    {
        $this->gmv = $gmv;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create($attributes)
    {
        return $this->gmv->create($attributes);
    }

    /**
     * @return Gmv[]|Collection
     */
    public function all()
    {
        return $this->gmv->all();
    }

    /**
     * @param mixed $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->gmv->find($id);
    }

    /**
     * @param mixed $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, array $attributes)
    {
        return $this->gmv->find($id)->update($attributes);
    }

    /**
     * @param mixed $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->gmv->find($id)->delete();
    }


    /**
     * get the data for the given date range for the month and the year
     * @param $year
     * @param $month
     * @param $range
     * @return mixed
     */
    public function getData($year, $month, $range)
    {
        // Create fields of array to retrieve
        $dayFields = array();
        $dayFields[] = 'brands.name AS brand';
        foreach ($range as $day) {
            $dayFields[] = "COALESCE(SUM(CASE WHEN DAY(gmv.date)=$day THEN gmv.turnover END),0) AS day_$day";
        }
        $dayFields[] = 'SUM(gmv.turnover) AS total_brand';
        $dayFields[] = 'ROUND(SUM(gmv.turnover)*79/100,2) AS total_vat';

        // create the date range
        $startDate = Carbon::createMidnightDate($year, $month, $range[0])->toDateTimeString();
        $endDate = Carbon::create($year, $month, end($range), 23, 59, 59)->toDateTimeString();

        // retrieve the results
        $results = $this->gmv
            ->select(DB::raw(implode(', ', $dayFields)))
            ->join('brands', 'gmv.brand_id', 'brands.id')
            ->whereBetween('gmv.date', [$startDate, $endDate])
            ->groupBy('brands.name')
            ->orderBy('brands.name')
            ->get();

        return $results;
    }
}
