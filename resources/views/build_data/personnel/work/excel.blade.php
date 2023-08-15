<div class="modal fade" id="modal-excel-work" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content" id="content-excel-payroll">
            <div class="modal-header">
                <h4 class="modal-title" id="title-detail-excel"> @lang('app.category-work-data.excel.title')</h4>
            </div>
            <div class="modal-body background-body-color text-left">
                <div class="card row">
                    <div class="card-block col-lg-12">
                        <div class="table-responsive" id="dvData">
                            <table class="table table-bordered" id="table_export_work"
                                   style="display: block; overflow-x: auto; white-space: nowrap;">
                                <thead>
                                <tr style="height:30px; text-align: center">
                                    <th style="background-color: #a2c4c9;"
                                        colspan="5">@lang('app.component.excel.text1')
                                        : {{Session::get(SESSION_KEY_DATA_RESTAURANT)['name']}}</th>
                                </tr>
                                <tr style="height:30px; text-align: center">
                                    <th colspan="5">@lang('app.component.excel.text2')
                                        : {{Session::get(SESSION_KEY_NAME_BRAND)}}
                                        @lang('app.component.excel.text3')
                                        : {{Session::get(SESSION_KEY_NAME_BRANCH)}}</th>
                                </tr>
                                <tr style="height:30px; text-align: center">
                                    <th colspan="5"></th>
                                </tr>
                                <tr style="height:30px; text-align: center">
                                    <th colspan="5" id="title-excel-food-report"
                                        style="background-color: #c5c5c5">DANH SÁCH CÔNG VIỆC
                                        <span id="type-inventory-food-report"></span></th>
                                </tr>
                                <tr style="height:30px; text-align: center; font-weight: bold">
                                    <th style="width: 400px;background-color: #f2f2f2;vertical-align: middle; " colspan="3">QUY TRÌNH LÀM VIỆC CỦA BỘ PHẬN</th>
                                    <th style="width: 300px;background-color: #f2f2f2;vertical-align: middle;  ">Công việc chi tiết</th>
                                    <th style="width: 130px;background-color: #f2f2f2;vertical-align: middle;  ">@lang('app.category-work-data.excel.kpi-point')</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                <tr>
                                    <td style="height: 30px" colspan="5"></td>
                                </tr>
                                <tr>
                                    <td style="text-align: center; background-color: #0c343d; color: #fff; height: 30px; vertical-align: middle"
                                        colspan="5">
                                        @lang('app.component.excel.text4')
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary waves-effect waves-light" onclick="ExportExcelWord()"
                        onkeypress="ExportExcelWord()">@lang('app.payroll-manage.export')</button>
                <button type="button" class="btn btn-grd-disabled waves-effect "
                        onclick="closeModalExcel()">@lang('app.payroll-manage.close')</button>
            </div>
        </div>
    </div>
</div>
