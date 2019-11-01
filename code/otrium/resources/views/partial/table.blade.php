<div class="">
    @if (count($data) > 0 )
        <table id="report_table" class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Brand</th>
                    @foreach($range as $day)
                        <th>{{ $monthName }} {{ $day  }}</th>
                    @endforeach
                    <th>Total [Per Brand]</th>
                    <th>Total without VAT 21% [Per Brand]</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $row)
                    <tr @if($loop->last)class="no-sort" @endif>
                        <td>{!! $row['brand'] !!}</td>
                        @foreach($range as $day)
                            <td>{{ $row['day_'.$day] }}</td>
                        @endforeach
                        <td>{{ $row['total_brand'] }}</td>
                        <td>{{ $row['total_vat'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-warning mt-4">
            <strong>Sorry!</strong> No records Found.
        </div>
    @endif
</div>
