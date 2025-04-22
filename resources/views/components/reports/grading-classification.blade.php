<div class="row">
    {{-- Grading --}}
    <div class="col-12 mb-2">
        <div class="card h-100">
            <div class="card-body p-1">
                <h6 class="text-center font-weight-bold mb-1">Grading System</h6>
                <table class="table table-striped table-bordered text-center">
                    <thead class="bg-dark text-white">
                        <tr><th>Score</th><th>Grade</th><th>Point</th></tr>
                    </thead>
                    <tbody>
                        @foreach ($grades as $grade)
                        <tr>
                            <td>{{ $grade['min'] }} - {{ $grade['max'] }}</td>
                            <td>{{ $grade['letter_grade'] }}</td>
                            <td>{{ number_format($grade['unit'], 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Classification --}}
    <div class="col-12 mb-2">
        <div class="card h-100">
            <div class="card-body p-1">
                <h6 class="text-center font-weight-bold mb-1">Classification</h6>
                <table class="table table-striped table-bordered text-center">
                    <thead class="bg-dark text-white">
                        <tr><th>CGPA</th><th>Class</th></tr>
                    </thead>
                    <tbody>
                        <tr><td>3.5 - 4.0</td><td>Distinction</td></tr>
                        <tr><td>3.0 - 3.49</td><td>Upper Credit</td></tr>
                        <tr><td>2.5 - 2.9</td><td>Lower Credit</td></tr>
                        <tr><td>2.0 - 2.49</td><td>Pass</td></tr>
                        <tr><td>Below 2.0</td><td>Fail</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
