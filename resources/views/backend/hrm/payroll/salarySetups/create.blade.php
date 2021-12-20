<div class="text-center">
    <button type="button" class="btn btn-primary mb-2 mr-2" data-toggle="modal" data-target="#exampleModal">
        @lang('site.add_new')
    </button>
</div>

{{-- handel add new --}}

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> @lang('site.add_new_salarySetup')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="@lang('site.close')">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-x">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <form action="{{route('dashboard.salarySetups.store')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">

                    <div class="row">

                        <div class="form-group col-12">

                            <label for="percent">@lang('site.employee')</label>

                            <select class="form-control basic" name="employee_id">
                                <option value="">---</option>

                                @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>

                                @endforeach

                            </select>
                        </div>



                    </div>
                    <div class="form-group row">

                        <label for="is_percentage" class="col-sm-3 col-form-label switch s-icons s-outline  s-outline-info  mb-4 mr-2">@lang('site.percentage') *</label>
                        <label class="switch s-icons s-outline  s-outline-info  mb-4 mr-2">
                            <input type="checkbox" name="is_percentage" id="ispercentage" value="" data-toggle="tooltip" data-placement="right" data-original-title="Check to calculate addition and deduction in percent."
                            onchange="handlepercent(this);" autocomplete="off" >
                            <span class="slider"></span>
                        </label>
                     </div>
                    <div class="row">

                        <table border="1" style="border: 1px solid #dedede;" width="100%">
                            <tbody>
                                <tr>
                                    <td class="col-sm-6 text-center" style="padding: 50px 20px;">
                                        <h4 class="addition_title">@lang('site.addition') </h4><br>
                                        <table id="add">
                                            <tbody>
                                                <tr>
                                                    <th class="padten">@lang('site.basic_salary')</th>
                                                    <td><input type="number" id="basic" name="basic"
                                                            class="form-control basic" onkeyup="salarySetupsummary()" autocomplete="off" min="0"></td>
                                                </tr>
                                                @foreach ($salaryType as $key => $item)
                                                    @if ($item->type == 'add' )

                                                    <tr>
                                                        <th class="padten">{{ $item->benefits }}<span class="percent"
                                                                style="display: none;">(%)<span></span></span></th>
                                                        <td><input type="number" name="addition[{{ $item->benefits }}]"
                                                                class="form-control addamount"
                                                                onkeyup="salarySetupsummary()" id="add_{{ $key+1 }}"
                                                                autocomplete="off" min="0"></td>
                                                    </tr>
                                                    @endif

                                                @endforeach


                                            </tbody>
                                        </table>
                                    </td>
                                    <td class="col-sm-6 text-center" style="padding: 50px 20px;">
                                        <h4 class="addition_title">@lang('site.deduction') </h4><br>
                                        <table id="dduct">
                                            <tbody>

                                            @foreach ($salaryType as $key => $item)
                                            @if ($item->type == 'deduct' )

                                            <tr>
                                                <th class="padten">{{ $item->benefits }}<span class="percent"
                                                        style="display: none;">(%)<span></span></span></th>
                                                <td><input type="number" name="deduction[{{ $item->benefits }}]"
                                                        class="form-control deducamount"
                                                        onkeyup="salarySetupsummary()" id="add_{{ $key+1 }}"
                                                        autocomplete="off" min="0"></td>
                                            </tr>
                                            @endif

                                        @endforeach
                                                <tr>
                                                    <th class="padten">@lang('site.tax')<span class="percent"
                                                            style="display: none;">(%)<span></span></span></th>
                                                    <td><input type="number" name="deduction[tax]"
                                                            onkeyup="salarySetupsummary()"
                                                            class="form-control deducamount" id="taxinput"
                                                            autocomplete="off" min="0"></td>

                                                </tr>

                                            </tbody>
                                        </table>

                                    </td>



                                </tr>
                            </tbody>
                        </table>



                    </div>

                    <div class="form-group row mt-4 ">
                        <label for="payable" class="col-md-3 col-form-label text-center">@lang('site.gross_salary')</label>
                             <div class="col-md-9">
                     <input type="text" class="form-control"  name="gross_salary" id="grsalary" readonly="" autocomplete="off">
                            </div>
                     </div>

                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal"><i
                            class="flaticon-cancel-12"></i>@lang('site.cancel')</button>
                    <button type="submit" class="btn btn-primary">@lang('site.save')</button>
                </div>
            </form>
        </div>
    </div>
</div>



