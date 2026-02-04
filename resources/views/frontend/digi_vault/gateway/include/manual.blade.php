<div class="col-xl-12 col-md-12">
    <div class="frontend-editor-data">
        {!! $paymentDetails !!}
    </div>
</div>

{{-- Show User's Bank Account Details for receiving funds --}}
@if(auth()->check() && auth()->user()->bankAccount)
<div class="col-xl-12 col-md-12 mb-3">
    <div class="site-card">
        <div class="site-card-header">
            <div class="title-small"><i data-lucide="landmark"></i> {{ __('Your DigiBank Account Details') }}</div>
        </div>
        <div class="site-card-body p-0">
            <div class="site-custom-table site-custom-table-sm">
                <div class="contents">
                    @php $bankAccount = auth()->user()->bankAccount; @endphp
                    <div class="site-table-list">
                        <div class="site-table-col"><strong>{{ __('Bank Name') }}</strong></div>
                        <div class="site-table-col">{{ $bankAccount->bank_name }}</div>
                    </div>
                    <div class="site-table-list">
                        <div class="site-table-col"><strong>{{ __('Account Name') }}</strong></div>
                        <div class="site-table-col">{{ $bankAccount->account_name }}</div>
                    </div>
                    <div class="site-table-list">
                        <div class="site-table-col"><strong>{{ __('Account Number') }}</strong></div>
                        <div class="site-table-col"><code>{{ $bankAccount->account_number }}</code></div>
                    </div>
                    <div class="site-table-list">
                        <div class="site-table-col"><strong>{{ __('Routing Number') }}</strong></div>
                        <div class="site-table-col"><code>{{ $bankAccount->routing_number }}</code></div>
                    </div>
                    <div class="site-table-list">
                        <div class="site-table-col"><strong>{{ __('SWIFT/BIC Code') }}</strong></div>
                        <div class="site-table-col"><code>{{ $bankAccount->swift_code }}</code></div>
                    </div>
                    <div class="site-table-list">
                        <div class="site-table-col"><strong>{{ __('IBAN') }}</strong></div>
                        <div class="site-table-col"><code>{{ $bankAccount->iban }}</code></div>
                    </div>
                    <div class="site-table-list">
                        <div class="site-table-col"><strong>{{ __('Branch') }}</strong></div>
                        <div class="site-table-col">{{ $bankAccount->branch_name }} ({{ $bankAccount->branch_code }})</div>
                    </div>
                    <div class="site-table-list">
                        <div class="site-table-col"><strong>{{ __('Account Type') }}</strong></div>
                        <div class="site-table-col">{{ $bankAccount->account_type }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@foreach (json_decode($fieldOptions, true) as $key => $field)
    @if ($field['type'] == 'file')
        <div class="col-xl-12 col-md-12">
            <div class="inputs">
                <label class="form-label">{{ $field['name'] }}</label>

                <div class="wrap-custom-file">
                    <input type="file" name="manual_data[{{ $field['name'] }}]" id="{{ $key }}"
                        accept=".gif, .jpg, .png" @if ($field['validation'] == 'required') required @endif />
                    <label for="{{ $key }}">
                        <img class="upload-icon" src="{{ asset('global/materials/upload.svg') }}" alt="" />
                        <span>{{ __('Select ') . $field['name'] }}</span>
                    </label>
                </div>
            </div>
        </div>
    @elseif($field['type'] == 'textarea')
        <div class="col-xl-12 col-md-12">
            <div class="inputs">
                <label class="form-label">{{ $field['name'] }}</label>
                <textarea class="box-textarea" @if ($field['validation'] == 'required') required @endif
                    name="manual_data[{{ $field['name'] }}]"></textarea>
            </div>
        </div>
    @else
        <div class="col-xl-12 col-md-12">
            <div class="inputs">
                <label class="form-label">{{ $field['name'] }}</label>
                <div class="input-group">
                    <input type="text" name="manual_data[{{ $field['name'] }}]"
                        @if ($field['validation'] == 'required') required @endif class="form-control">
                </div>
            </div>
        </div>
    @endif
@endforeach
