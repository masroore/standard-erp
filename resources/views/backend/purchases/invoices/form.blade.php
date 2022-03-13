
        <div class="invoice-detail-title">
            <h4 class="font-weight-bold"> @lang('site.add_purchases')</h4>
            <a href="{{ route('dashboard.purchases.index') }}" class="btn btn-primary float-right"><i class="fa fa-list"></i> @lang('site.purchases_list')</a>

        </div>

        {{-- master data --}}

        @include('backend.purchases.invoices.parts.create_master_data')

        {{-- items details --}}
         
        @include('backend.purchases.invoices.parts.create_item_details')

         {{-- totals details --}}

        @include('backend.purchases.invoices.parts.create_total_details')


        {{-- notes --}}
        <div class="invoice-detail-note">
            <div class="row">
                <div class="col-md-12 align-self-center">
                    <div class="form-group row invoice-note">
                        <label for="invoice-detail-notes" class="col-sm-12 col-form-label col-form-label-sm">@lang('site.notes'):</label>
                        <div class="col-sm-12">
                            <textarea class="form-control" name="note" id="invoice-detail-notes" placeholder='@lang('site.write_note')' style="height: 88px;"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>




