
                    <table class="table table-bordered item-table">

                        <tbody>


                        @if ($paymentRow->paying_method == 'check')
                            <tr>
                                <th> @lang('site.code') </th>
                                <td class="border-dark border-top"> {{ $paymentRow->code }} </td>
                            </tr>
                            <tr>
                                <th> @lang('site.date')</th>
                                <td> {{ $paymentRow->created_at }} </td>
                            </tr>
                            <tr>
                                <th> @lang('site.ref')</th>
                                <td> {{ $paymentRow->ref }} </td>
                            </tr>
                            <tr>
                                <th> @lang('site.amount')</th>
                                <td> {{ $paymentRow->amount }} </td>
                            </tr>
                            <tr>
                                <th> @lang('site.pay_type')</th>
                                <td> {{ $paymentRow->paying_method }} </td>
                            </tr>
                            <tr>
                                <th> @lang('site.bank')</th>
                                <td> {{ $paymentRow->bank->title_en ?? ''}} </td>
                            </tr>
                            <tr>
                                <th> @lang('site.document_code')</th>
                                <td> {{ $paymentRow->document_code }} </td>
                            </tr>
                            <tr>
                                <th> @lang('site.check_receive_date')</th>
                                <td> {{ $paymentRow->check_receive_date }} </td>
                            </tr>
                            <tr>
                                <th> @lang('site.due_date')</th>
                                <td> {{ $paymentRow->due_date }} </td>
                            </tr>
                        @elseif ($paymentRow->paying_method == 'transfare')
                            <tr>
                                <th> @lang('site.code') </th>
                                <td class=" border-top"> {{ $paymentRow->code }} </td>
                            </tr>
                            <tr>
                                <th> @lang('site.date')</th>
                                <td> {{ $paymentRow->created_at }} </td>
                            </tr>
                            <tr>
                                <th> @lang('site.ref')</th>
                                <td> {{ $paymentRow->ref }} </td>
                            </tr>
                            <tr>
                                <th> @lang('site.amount')</th>
                                <td> {{ $paymentRow->amount }} </td>
                            </tr>
                            <tr>
                                <th> @lang('site.pay_type')</th>
                                <td> {{ $paymentRow->paying_method }} </td>
                            </tr>
                            <tr>
                                <th> @lang('site.bank')</th>
                                <td> {{ $paymentRow->bank->title_en ?? ''}} </td>
                            </tr>
                            <tr>
                                <th> @lang('site.document_code')</th>
                                <td> {{ $paymentRow->document_code }} </td>
                            </tr>
                            <tr>
                                <th> @lang('site.bank_transfare_fees')</th>
                                <td> {{ $paymentRow->bank_transfare_fees }} </td>
                            </tr>
                            <tr>
                                <th> @lang('site.due_date')</th>
                                <td> {{ $paymentRow->due_date }} </td>
                            </tr>
                        @else
                            <tr>
                                <th> @lang('site.code') </th>
                                <td class=" border-top"> {{ $paymentRow->code }} </td>
                            </tr>
                            <tr>
                                <th> @lang('site.date')</th>
                                <td> {{ $paymentRow->created_at }} </td>
                            </tr>
                            <tr>
                                <th> @lang('site.ref')</th>
                                <td> {{ $paymentRow->ref }} </td>
                            </tr>
                            <tr>
                                <th> @lang('site.amount')</th>
                                <td> {{ $paymentRow->amount }} </td>
                            </tr>
                            <tr>
                                <th> @lang('site.pay_type')</th>
                                <td> {{ $paymentRow->paying_method }} </td>
                            </tr>
                            <tr>
                                <th> @lang('site.created_by')</th>
                                <td> {{ $paymentRow->user->name }} </td>
                            </tr>
                            <tr>
                                <th> @lang('site.notes') </th>
                                <td> {{ $paymentRow->notes }} </td>
                            </tr>

                        @endif

                        </tbody>
                    </table>




