<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')

    <style type="text/css">
        .div_center {
            text-align: center;
            padding-top: 40px;
        }

        .font_size {
            font-size: 40px;
            padding-bottom: 40px;
        }

        .text_color {
            color: black;
            padding-bottom: 20px;
        }

        label {
            display: inline-block;
            width: 200px;
        }

        .div_design {
            padding-bottom: 15px;

        }
    </style>

</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            @include('admin.navbar')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <div class="div_center">

                        <h1 class="font_size">Update Product</h1>

                        <form action="{{ url('/update_product_confirm',$product->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="div_design">
                                <label for="">Product Title :</label>
                                <input class="text_color" type="text" name="title" id=""
                                    placeholder="Write a Title " required="" value="{{ $product->title }}">
                            </div>

                            <div class="div_design">
                                <label for="">Product Description :</label>
                                <input class="text_color" type="text" name="description" id=""
                                    placeholder="Write a Description " required="" value="{{ $product->description }}">
                            </div>

                            <div class="div_design">
                                <label for="">Product Stock :</label>
                                <input class="text_color" type="number" name="stock" id=""
                                    placeholder="Write a stock " required="" value="{{ $product->stock }}">
                            </div>

                            <div class="div_design">
                                <label for="">Product Price :</label>
                                <input class="text_color" type="number" min="1" name="price" id=""
                                    placeholder="Write a Price " required="" value="{{ $product->price }}">
                            </div>
                            <div class="div_design">
                                <label for="">Product Discount :</label>
                                <input class="text_color" type="number" min="1" name="price" id=""
                                    placeholder="Write a Discount " value="{{ $product->discount_percentage }}">
                            </div>
                            <div class="div_design">
                                <label for="">Product Quantity :</label>
                                <input class="text_color" type="number" min="0" name="quantity" id=""
                                    placeholder="Write a Quantity " required="" value="{{ $product->quantity }}">
                            </div>

                            <div class="div_design">
                                <label for="">Product Category :</label>

                                <select class="text_color" name="category" id="" required="">
                                    <option value="{{ $product->category }}" selected>{{ $product->category }}</option>
                                    @foreach ($category as $category)
                                        <option value="{{ $category->category_name }}">{{ $category->category_name }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                            {{-- Current Image --}}
                            <div class="div_design">
                                <label for="">Current Image Here :</label>

                                <img style="margin: auto;" height="100" width="100" src="/product/{{ $product->image }}" alt="">
                            </div>

                            {{-- Updated Image --}}
                            <div class="div_design">
                                <label for="">Change Image Here :</label>

                                <input type="file" name="image">
                            </div>

                            <div>
                                <input type="submit" value="Update Product" class="btn btn-primary" required="">
                            </div>
                        </form>

                    </div>
                </div>
                @include('admin.footer')
            </div>

            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    @include('admin.js')
</body>

</html>
