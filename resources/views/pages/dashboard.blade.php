@extends("layouts.accountLayout")
@section('account')
 <div class="Dasboard">
    <div class="box-Content">
        <div class="box">
            <div class="ico">
               <i class="uil uil-dollar-alt"></i>
            </div>
            <div class="info">
                <div class="libele">Credit Balance</div>
                <div class="value">1000</div>
            </div>
        </div>

        <div class="box">
                <div class="ico">
                    <i class="uil uil-table"></i>
                </div>
            <div class="info">
                <div class="libele">BULK SKIPTRACE FILES</div>
                <div class="value">19 of 20</div>
            </div>
        </div>
        <div class="box">
            <div class="ico">
                <i class="uil uil-columns"></i>
            </div>
        <div class="info">
            <div class="libele">SINGLE SKIPTRACE RECORDS</div>
            <div class="value">15 of 17</div>
        </div>
    </div>
    </div>
    <div class="contentTable">
        <h5>Skip Tracing List</h5>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>CSV File</th>
                    <th>Pending Records</th>
                    <th>Success</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr >
                    <td>#19</td>
                    <td>Skiptracing_final_1707723106.csv</td>
                    <td>9732</td>
                    <td>97</td>
                    <td class="action">
                        <span><i class="uil uil-import"></i></span>
                    </td>
                </tr>
                <tr >
                    <td>#19</td>
                    <td>Skiptracing_final_1707723106.csv</td>
                    <td>9732</td>
                    <td>97</td>
                    <td class="action">
                        <span><i class="uil uil-import"></i></span>
                    </td>
                </tr>
                <tr >
                    <td>#19</td>
                    <td>Skiptracing_final_1707723106.csv</td>
                    <td>9732</td>
                    <td>97</td>
                    <td class="action">
                        <span><i class="uil uil-import"></i></span>
                    </td>
                </tr>
                <tr >
                    <td>#19</td>
                    <td>Skiptracing_final_1707723106.csv</td>
                    <td>9732</td>
                    <td>97</td>
                    <td class="action">
                        <span><i class="uil uil-import"></i></span>
                    </td>
                </tr>



            </tbody>
        </table>
    </div>
</d>
@endsection
