@extends('layouts.accountLayout')

@section('account')
 <section class="bulk-skip">
            <!-- <div class="box-Content">
                <Button>Ajouter un produit</Button>
            </div> -->
        <div class="contentTable">
            <div class="contentfloat">
                <form action="">
                    <div class="card">
                        <h5>Import Skip CSV</h5>
                        <div class="row">
                            <div class="groupeForm">
                                <label for="">Choose file</label>
                                <div class="forminput">
                                    <input type="file" placeholder="10000">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="groupebtn">
                        <button>
                            Upload CSV
                            <i class="uil uil-file-upload-alt"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="table">
                <div class="thead">
                <h5>Pending CSV File List</h5>
                <a href="/bulkSkip_list">
                    Skip Tracing List
                </a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Csv File</th>
                            <th>Total CSV Records</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                        <tbody>
                            <tr>
                                <td>#14</td>
                                <td>douma_1710491272.csv</td>
                                <td>2</td>
                                <td>2024-03-15 08:27:52</td>
                                    <td class="action">
                                    <span>
                                    <i class="uil uil-sync"></i>
                                    </span>
                                    <span><i class="uil uil-trash-alt"></i></span>
                                </td>
                            </tr>
                             <tr>
                                <td>#14</td>
                                <td>douma_1710491272.csv</td>
                                <td>2</td>
                                <td>2024-03-15 08:27:52</td>
                                    <td class="action">
                                    <span>
                                    <i class="uil uil-sync"></i>
                                    </span>
                                    <span><i class="uil uil-trash-alt"></i></span>
                                </td>
                            </tr>

                             <tr>
                                <td>#14</td>
                                <td>douma_1710491272.csv</td>
                                <td>2</td>
                                <td>2024-03-15 08:27:52</td>
                                    <td class="action">
                                    <span>
                                    <i class="uil uil-sync"></i>
                                    </span>
                                    <span><i class="uil uil-trash-alt"></i></span>
                                </td>
                            </tr>

                             <tr>
                                <td>#14</td>
                                <td>douma_1710491272.csv</td>
                                <td>2</td>
                                <td>2024-03-15 08:27:52</td>
                                    <td class="action">
                                    <span>
                                    <i class="uil uil-sync"></i>
                                    </span>
                                    <span><i class="uil uil-trash-alt"></i></span>
                                </td>
                            </tr>

                             <tr>
                                <td>#14</td>
                                <td>douma_1710491272.csv</td>
                                <td>2</td>
                                <td>2024-03-15 08:27:52</td>
                                    <td class="action">
                                    <span>
                                    <i class="uil uil-sync"></i>
                                    </span>
                                    <span><i class="uil uil-trash-alt"></i></span>
                                </td>
                            </tr>

                             <tr>
                                <td>#14</td>
                                <td>douma_1710491272.csv</td>
                                <td>2</td>
                                <td>2024-03-15 08:27:52</td>
                                    <td class="action">
                                    <span>
                                    <i class="uil uil-sync"></i>
                                    </span>
                                    <span><i class="uil uil-trash-alt"></i></span>
                                </td>
                            </tr>

                        </tbody>
                </table>
            </div>
        </div>

    </section>
@endsection
