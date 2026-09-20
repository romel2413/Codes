


<section class="product_section layout_padding">
    <div class="container">
        <div class="row">
            @foreach ($product as $product_page)
                <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                    <div class="box">
                        <div class="option_container">
                            <div class="options">
                                @if ($product_page->stock === '0')
                                    <span class="option1">
                                        OUT OF STOCK
                                    </span>
                                @else
                                    <span class="option1">
                                        AVAILABLE
                                    </span>
                                @endif
                                <p>{{ $product_page->description }}</p>
                                <form action="{{ url('add_cart', $product_page->id) }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-2 col-lg-7">
                                            <input type="number" name="quantity" value="1" min="1"
                                                max="{{ $product_page->stock }}"
                                                oninput="checkQuantity(this, {{ $product_page->stock }})"
                                                id="quantityInput" style="width: 100%;">
                                            <div id="quantityMessage" style="color: red;"></div>
                                        </div>
                                        <div class="col-md-6 col-lg-4" style="padding-left: 15px;">
                                            <button type="submit" class="btn btn-outline-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="35"
                                                    fill="blue" class="bi bi-cart" viewBox="0 0 16 16">
                                                    <path
                                                        d="M0 1a1 1 0 0 1 1-1h1.958l1.922 7.679a1 1 0 0 0 .976.821h6.025a1 1 0 0 0 .976-.822L15 2H3a1 1 0 0 0-1 1zm1 2a.978.978 0 0 1 .085-.41l.12-.31h12.79a.978.978 0 0 1 .986 1.16L14.197 10H1V3zm2.293 11.293a1 1 0 0 1-1.414-1.414L5.586 11H12a1 1 0 1 1 0 2H5.586l-2.707 2.707a1 1 0 0 1-1.414 0z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="img-box">
                            <img src="product/{{ $product_page->image }}" alt="">
                        </div>
                        <div class="detail-box">
                            <h5 style="color: gray">
                                Product
                                <br>
                                {{ $product_page->title }}
                            </h5>

                            @if ($product_page->discount_percentage != null)
                            <h6 style="color: blue">
                                Price
                                <br>
                                ₱{{ $product_page->price }}
                            </h6>
                            <h6 style="color: blue; text-decoration:line-through;">
                                Originial Price
                                <br>
                                ₱{{ $product_page->original_price }}
                            </h6>
                            @else
                            <h6 style="color: blue; text-decoration:line-through;">
                                Originial Price
                                <br>
                                ₱{{ $product_page->price }}
                            </h6>
                            @endif

                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<script>
    function checkQuantity(input, availableStock) {
        var enteredQuantity = parseInt(input.value);
        var quantityMessage = document.getElementById('quantityMessage');

        if (enteredQuantity > availableStock) {
            input.value = availableStock; // Limit the input to available stock
            quantityMessage.textContent = 'Quantity exceeds available stock';
        } else {
            quantityMessage.textContent = ''; // Clear the error message
        }
    }
</script>
