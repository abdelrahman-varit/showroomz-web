@if((auth()->guard('customer')->user()) == null)
    @if(core()->getCurrentChannel()->theme == "velocity")
        <ul type="none">
            <li class="sell-button">
                <a href="{{ route('marketplace.seller_central.index') }}">
                    {{ __('marksdfsadetplace::app.shop.layouts.sell') }}
                </a>
            </li>
        </ul>
    @else
        <li>
            <a style="color: #242424" href="{{ route('marketplace.seller_central.index') }}">
                {{ __('marketplace::app.shop.layouts.sell') }}
            </a>
        </li>
    @endif
@endif