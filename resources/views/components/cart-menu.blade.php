<div>
    <div class="navbar-cart">
        <div class="wishlist">
            <a href="javascript:void(0)">
                <i class="lni lni-heart"></i>
                <span class="total-items">0</span>
            </a>
        </div>
        <div class="cart-items">
            <a href="javascript:void(0)" class="main-btn">
                <i class="lni lni-cart"></i>
                <span class="total-items">{{  $items->count()  }}</span>
            </a>
      <!-- Shopping Item -->
      <div class="shopping-item">
        <div class="dropdown-cart-header">
            <span>{{ $items->count() }} Items</span>
            <a href="cart.html">View Cart</a>
        </div>
        <ul class="shopping-list">
            @foreach ($items as $item)
            <li>
                <form action="{{ route('cart.destroy' , $item->id) }}" id="deleteForm" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="remove"><i class="lni lni-close"></i></button>
                </form>
                {{-- <a href="javascript:void(0)" class="remove" title="Remove this item"><i
                        class="lni lni-close"></i></a> --}}
                <div class="cart-img-head">
                    <a class="cart-img" href="{{ route('products.show', $item->product->slug) }}"><img
                            src="{{ $item->product->image_url }}" alt="#"></a>
                </div>

                <div class="content">
                    <h4><a href="{{ route('products.show', $item->product->slug) }}">
                          {{  $item->product->name }} </a></h4>
                    <p class="quantity">{{ $item->quantity }}x - <span class="amount">{{ Currency::format($item->quantity * $item->product->price) }}</span></p>
                </div>
            </li>
            @endforeach
        </ul>
        <div class="bottom">
            <div class="total">
                <span>Total</span>
                <span class="total-amount">{{ Currency::format($total) }}</span>
            </div>
            <div class="button">
                <a href="checkout.html" class="btn animate">Checkout</a>
            </div>
        </div>
    </div>
    </div>
    </div>
    <!--/ End Shopping Item -->
</div>