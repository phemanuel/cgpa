@if(count($data) === 0)
    <div class="alert alert-warning">
        No programmes found for session {{ $session }}.
    </div>
@else
    <table class="table table-bordered table-sm">
        <thead class="thead-dark">
            <tr>
                <th style="width: 25%">Programme</th>
                <th style="width: 15%">Level</th>
                <th style="width: 20%">Semester</th>
                <th style="width: 20%">Session</th>
                <th style="width: 20%">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach(collect($data)->groupBy('programme') as $programme => $rows)
                <!-- Programme header row -->
                <tr class="table-primary">
                    <td colspan="5">
                        <strong>{{ $programme }}</strong>
                    </td>
                </tr>

                <!-- Programme details -->
                @foreach($rows as $row)
                    <tr class="{{ $row['available'] ? 'table-success' : 'table-danger' }}">
                        <td></td> <!-- keep Programme cell empty under grouped header -->
                        <td>{{ $row['level'] }}</td>
                        <td>{{ ucfirst($row['semester']) }}</td>
                        <td>{{ $row['session'] }}</td>
                        <td>
                            @if($row['available'])
                                <i class="fa fa-check text-success"></i> Available
                            @else
                                <i class="fa fa-times text-danger"></i> Not Available
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
@endif
