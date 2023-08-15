<div class="modal-body text-left d-none modal-body-create-unit-material-data" id="load-modal-body-create-unit-material-data">
    <div class="row">
        <div class="col-lg-12">
            <div class="card-block card m-0">
                    <div class="form-group validate-group">
                        <div class="form-validate-input">
                        <input id="name-create-unit-material-data" class="form-control name-create-unit-material-data" type="text" data-spec="1" data-empty="1" data-min-length="2" data-max-length="50">
                        <label for="name-create-unit-material-data">
                            @lang('app.material-data.create_unit.name')
                            @include('layouts.start')
                        </label>
                            <div class="line"></div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                    <div class="form-group validate-group">
                        <div class="form-validate-input">
                        <input id="code-create-unit-material-data" class="form-control code-create-unit-material-data" type="text" data-empty="1" data-max-length="50" data-min-length="2" data-only-text="1" data-spec="1">
                        <label for="code-create-unit-material-data">
                            @lang('app.unit-data.create.code')
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
                                    <select id="select-specifications-create-unit-material-data" class="select-specifications-create-unit-material-data select-not-select2 select2-hidden-accessible" multiple="" data-select="1">
                                    </select>
                                    <label class="icon-validate">
                                        @lang('app.material-data.create_unit.specifications')
                                        @include('layouts.start')
                                    </label>
                                    <div class="line"></div>
                                </div>
                            </div>
                        </div>
                        <div class="link-href"></div>
                    </div>
                <div class="form-group validate-group">
                    <div class="form-validate-textarea">
                        <div class="form__group pt-2">
                            <textarea class="form__field description-create-unit-material-data" id="description-create-unit-material-data" data-note-max-length="300" cols="5" rows="3"></textarea>
                            <label for="description-create-unit-material-data" class="form__label icon-validate">
                                @lang('app.material-data.create_unit.description')
                            </label>
                            <div class="textarea-character" id="char-count">
                                <span>0/300</span>
                            </div>
                            <div class="line"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
