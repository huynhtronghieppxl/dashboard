<div class="modal-body text-left d-none modal-body-create-specifications-material-data" id="load-modal-body-create-specifications-material-data">
    <div class="row">
        <div class="col-lg-12">
            <div class="card-block card m-0">
                <div class="form-group validate-group">
                    <div class="form-validate-input">
                        <input class="form-control name-create-specifications-material-data" id="name-create-specifications-material-data" data-spec="1" data-empty="1" data-max-length="50" data-min-length="2">
                        <label for="name-create-specifications-material-data">
                            @lang('app.material-data.create_specifications.name')
                            @include('layouts.start')
                        </label>
                        <div class="line"></div>
                    </div><div class="link-href"></div>
                </div>
                <div class="form-group validate-group">
                    <div class="form-validate-input">
                        <input class="form-control value-exchange-create-specifications-material-data" id="value-exchange-create-specifications-material-data" value="1" data-float="1" data-empty="1" data-value-min-value-of="0" data-max="100000">
                        <label for="value-exchange-create-specifications-material-data">
                            @lang('app.material-data.create_specifications.value-exchange')
                            @include('layouts.start')
                        </label>
                        <div class="line"></div>
                    </div>
                    <div class="link-href"></div>
                </div>
                <div class="form-group select2_theme validate-group">
                    <div class="form-validate-select">
                        <div class="col-lg-12 mx-0 px-0">
                            <div class="pr-0 select-material-box">
                                <select id="value-name-create-specifications-material-data" class="value-name-create-specifications-material-data select-not-select2 select2-hidden-accessible" data-select="1">
                                </select>
                                <label class="icon-validate">
                                    @lang('app.material-data.create_specifications.value-name')
                                    @include('layouts.start')
                                </label>
                                <div class="line"></div>
                            </div>
                        </div>
                    </div>
                    <div class="link-href"></div>
                </div>
                <div class="row">
                    <div class="col-12 pb-4">
                        <p class="text text-warning">
                            <span>*@lang('app.specifications-data.note.note-vd')</span><br>
                            <span>@lang('app.specifications-data.note.note-name')</span><br>
                            <span>@lang('app.specifications-data.note.note-value')</span><br>
                            <span>@lang('app.specifications-data.note.note-unit')</span>
                        </p>
                    </div>
                </div>
                <div class="d-none">
                    <input class="unit-id-dnone-input">
                </div>
            </div>
        </div>
    </div>
</div>
