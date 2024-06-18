@extends('layouts.default')
@section('content')

<body>
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success m-0 p-3 alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close p-3.5" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger m-0 p-1">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row align-items pt-4">
            <div class="card col m-3 px-0">
                <div class="card-header">
                    Създаване на Контрагент
                </div>
                <div class="card-body mx-3">
                    <form action="{{ route('counterparties.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="counterpartyname" class="form-label">Име:</label>
                            <input type="text" id="counterpartyname" name="counterpartyname" class="form-control" required value="{{ old('counterpartyname') }}">
                            @error('counterpartyname')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="bulstat" class="form-label">Булстат:</label>
                            <input type="number" min="0" step="0.01" id="bulstat" name="bulstat" class="form-control" required value="{{ old('bulstat') }}">
                            @error('bulstat')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Адрес:</label>
                            <input type="text" id="address" name="address" class="form-control" required value="{{ old('address') }}">
                            @error('address')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail:</label>
                            <input type="email" id="email" name="email" class="form-control">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Създаване</button>
                    </form>
                </div>
                
            </div>

            <div class="card col m-3 px-0">
                <div class="card-header">
                    Създаване на Продукт
                </div>
                <div class="card-body mx-3">
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Име на продукт:</label>
                            <input type="text" id="name" name="name" class="form-control" required value="{{ old('name') }}">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Цена:</label>
                            <input type="number" min="0" step="0.01" id="price" name="price" class="form-control" required value="{{ old('price') }}">
                            @error('price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Снимка (URL):</label>
                            <input type="file" id="image" name="image" class="form-control" value="{{ old('image') }}">
                            @error('image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Създаване</button>
                    </form>
                </div>
                
            </div>
        </div>


        <div class="card mt-3 mb-5 px-0">
            <div class="card-header">
                Форма за Продажба
            </div>
            <div class="card-body m-3">
                <form id="salesForm" action="{{ route('sales.store') }}" method="POST">
                    @csrf
                    <div id="formsContainer">
                        <div class="sale-form">
                            <div class="mb-3">
                                <label for="counterparty_id_0" class="form-label">Контрагент:</label>
                                <select name="sales[0][counterparty_id]" id="counterparty_id_0" class="form-select" required>
                                    <option value="">Select Counterparty</option>
                                    @foreach($counterparties as $counterparty)
                                        <option value="{{ $counterparty->id }}">{{ $counterparty->counterpartyname }}</option>
                                    @endforeach
                                    @error('counterparty_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </select>
                            </div>

                            <div class="row">
                                <label for="product_id_0" class="form-label col col-7">Продукт:</label>
                                <label for="amount_0" class="form-label col col-1">Кол.</label>
                                <label for="productPrice_0" class="form-label col col-2">Единична цена:</label>
                                <label for="total_0" class="form-label col col-1">Сума:</label>
                            </div>
                            <div class="row product-row mb-3">
                                <span class="col col-7">
                                    <input name="sales[0][product_name]" class="form-control product-name" type="text" required>
                                    <input type="hidden" name="sales[0][product_id]" class="product-id">
                                    @error('product_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </span>
                                
                                <span class="col col-1">
                                    <input type="number" name="sales[0][amount]" id="amount_0" class="form-control amount" min="1" value="1" required>
                                    @error('amount')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </span>
                                <span class="col col-2 price my-1">0</span>
                                <span class="col col-1 total my-1">0</span>
                                <button type="button" class="btn btn-danger remove-product col col-1 p-0" style="display:none">Изтриване</button>
                            </div>
                        </div>
                    </div>

                    <button type="button" id="add" class="btn btn-secondary mt-2">+</button>
                    <button type="submit" class="btn btn-primary mt-2">Създаване</button>
                </form>
            </div>
        </div>
    </div>
</body>

<script>
    $(document).ready(function() {
        var formCount = 1;

        function bindEvents(row) {
            var availableProducts = [
                @foreach($products as $product)
                    { label: '{{ $product->name }}', id: '{{ $product->id }}' },
                @endforeach
            ];

            row.find('.product-name').autocomplete({
                source: availableProducts,
                select: function(event, ui) {
                    var selectedProduct = ui.item.id;
                    row.find('.product-id').val(selectedProduct);
                    var priceElement = row.find('.price');

                    $.ajax({
                        url: '{{ route("products.show", ":id") }}'.replace(':id', selectedProduct),
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            priceElement.text(response.product.price);
                            updateTotal(row);
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                }
            });

            row.find('.amount').change(function() {
                updateTotal(row);
            });

            row.find('.remove-product').click(function() {
                row.remove();
            });
        }

        bindEvents($('.product-row').last());

        function updateTotal(row) {
            var price = parseFloat(row.find('.price').text());
            var amount = parseInt(row.find('.amount').val()) || 0;
            var total = price * amount;
            row.find('.total').text(total.toFixed(2));
        }

        $('#add').click(function() {
            var newRow = $('.sale-form').first().clone();
            newRow.find('input, select').each(function() {
                var name = $(this).attr('name');
                var id = $(this).attr('id');
                if (name) {
                    $(this).attr('name', name.replace(/\d+/, formCount));
                }
                if (id) {
                    $(this).attr('id', id.replace(/\d+/, formCount));
                }
                $(this).val('');
            });
            newRow.find('.amount').val('1');
            newRow.find('.price').text('0');
            newRow.find('.total').text('0');
            newRow.find('.remove-product').show();

            $('#formsContainer').append(newRow);
            bindEvents(newRow);
            formCount++;
        });
    });
</script>
@stop
