<!-- resources/views/dates.blade.php -->

@extends('app')

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation Errors -->

        <!-- New Date Form -->
        <form action="/dates" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <!-- Date Name -->
            <div class="form-group">
                <label for="date" class="col-sm-3 control-label">Add Date</label>

                <div class="col-sm-6">
                    <input type="date" name="date" id="date" class="form-control">
                    <input type="number" name="max" id="max" class="form-control">
                    <input type="number" name="min" id="min" class="form-control">
                </div>
            </div>

            <!-- Add Date Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Add Date
                    </button>
                </div>
            </div>
        </form>

        <!-- Update Date Form -->
        <form action="/dates" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <!-- Date Name -->
            <div class="form-group">
                <label for="date" class="col-sm-3 control-label">Update Date</label>

                <div class="col-sm-6">
                    <input type="text" name="update_id" id="update-id" class="form-control" style="display:none;">
                    <input type="date" name="update_date" id="update-date" class="form-control">
                    <input type="number" name="update_max" id="update-max" class="form-control">
                    <input type="number" name="update_min" id="update-min" class="form-control">
                </div>
            </div>

            <!-- Update Date Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Update Date
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Table Body -->
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Max</th>
                <th>Min</th>
                <th>Variance</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Average</th>
                <th>{{ $average_max }}</th>
                <th>{{ $average_min }}</th>
                <th>{{ $average_max - $average_min }}</th>
            </tr>
        </tfoot>
        <tbody>
            @foreach ($dates as $date)
                <tr>
                    <td>
                        {{ $date->date }}
                    </td>
                    <td>
                        {{ $date->max }}
                    </td>
                    <td>
                        {{ $date->min }}
                    </td>
                    <td>
                        {{ $date->max - $date->min }}
                    </td>

                    <!-- Delete Button -->
                    <td>
                        <form action="/dates/{{ $date->id }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button>Delete Date</button>
                        </form>
                    </td>

                    <!-- Update Button -->
                    <td>
                        <button onclick="setUpdate({{ $date->id }}, '{{ $date->date }}', {{ $date->max }}, {{ $date->min }})">Update</button>

                    <script>
                        function setUpdate(id, date, max, min) {
                            document.getElementById("update-id").value = id;
                            document.getElementById("update-date").value = date;
                            document.getElementById("update-max").value = max;
                            document.getElementById("update-min").value = min;
                        }
                    </script>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection