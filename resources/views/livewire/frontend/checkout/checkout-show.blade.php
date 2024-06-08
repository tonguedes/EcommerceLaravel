<div>
    <div class="py-3 py-md-4 checkout">
        <div class="container">
            <h4>Checkout</h4>
            @if (session('message'))
                <h5 class="alert alert-success mb-2">{{ session('message') }}</h5>
            @endif
            <hr>
            @if ($this->totalProductAmount != '0')
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="shadow bg-white p-3">
                            <h4 class="text-primary">
                                Quantidade todal :
                                <span class="float-end">R${{ $this->totalProductAmount }}</span>
                            </h4>
                            <hr>
                            <small>* Items will be delivered in 3 - 5 days.</small>
                            <br />
                            <small>* Tax and other charges are included ?</small>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="shadow bg-white p-3">
                            <h4 class="text-primary">
                                Basic Information
                            </h4>
                            <hr>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Full Name</label>
                                    <input type="text" wire:model.defer='fullname' id="fullname" name="fullname"
                                        class="form-control" placeholder="Enter Full Name" />
                                    @error('fullname')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Phone Number</label>
                                    <input type="number" wire:model.defer='phone' id="phone" name="phone"
                                        class="form-control" placeholder="Enter Phone Number" />
                                    @error('phone')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Email Address</label>
                                    <input type="email" wire:model.defer='email' name="email" id="email"
                                        class="form-control" placeholder="Enter Email Address" />
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Pin-code (Zip-code)</label>
                                    <input type="number" wire:model.defer='pincode' name="pincode" id="pincode"
                                        class="form-control" placeholder="Enter Pin-code" />
                                    @error('pincode')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label>Full Address</label>
                                    <textarea name="address" wire:model.defer='address'id="address" class="form-control" rows="2"></textarea>
                                    @error('address')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3" wire:ignore>
                                    <label>Select Payment Mode: </label>
                                    <div class="d-md-flex align-items-start">
                                        <div class="nav col-md-3 flex-column nav-pills me-3" id="v-pills-tab"
                                            role="tablist" aria-orientation="vertical">
                                            <button wire.loading.attr="disabled" wire.loading.attr="disabled"
                                                class="nav-link  fw-bold" id="cashOnDeliveryTab-tab"
                                                data-bs-toggle="pill" data-bs-target="#cashOnDeliveryTab" type="button"
                                                role="tab" aria-controls="cashOnDeliveryTab"
                                                aria-selected="true">Cash
                                                on Delivery</button>
                                            <button class="nav-link active show fw-bold" id="onlinePayment-tab"
                                                data-bs-toggle="pill" data-bs-target="#onlinePayment" type="button"
                                                role="tab" aria-controls="onlinePayment"
                                                aria-selected="false">Online Payment</button>
                                        </div>
                                        <div class="tab-content col-md-9" id="v-pills-tabContent">
                                            <div class="tab-pane fade" id="cashOnDeliveryTab" role="tabpanel"
                                                aria-labelledby="cashOnDeliveryTab-tab" tabindex="0">
                                                <h6>Cash on Delivery Mode</h6>
                                                <hr />
                                                <button type="button" wire.loading.attr="disabled"
                                                    wire:click='codOrder' class="btn btn-primary">
                                                    <span wire:loading.remove wire:tatget='codOrder'>
                                                        Place Order (Cash on
                                                        Delivery)
                                                    </span>
                                                    <span wire:loading wire:tatget='codOrder'>
                                                        Placing order
                                                    </span>
                                                </button>

                                            </div>
                                            <div class="tab-pane fade" id="onlinePayment" role="tabpanel"
                                                aria-labelledby="onlinePayment-tab" tabindex="0">
                                                <h6>Online Payment Mode</h6>
                                                <hr />
                                                {{-- <button type="button"  wire.loading.attr="disabled" class="btn btn-warning">Pay Now (Online
                                                    Payment)</button> --}}
                                                <div>
                                                    <div id="paypal-button-container"></div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            @else
                <div class="card card-body shadow text-center  p-md-5">
                    <h4>sem items no carrinho para checkout</h4>
                    <a href="{{ url('collections') }}" class="btn btn-warning">Shop now</a>
                </div>
            @endif

        </div>
    </div>
</div>

@push('scripts')
 {{-- <script

src="https://www.paypal.com/sdk/js?client-id=AdmGanfuMzYFHCWoY5dsE0tAHIMA0fJfPfYjHWY42Pl6jszB9mJ4sY5onDsAzsL9ZrZiON5D7WWYsUpl&currency=USD">

</script> --}}

     <script
        src="https://www.paypal.com/sdk/js?client-id=AdmGanfuMzYFHCWoY5dsE0tAHIMA0fJfPfYjHWY42Pl6jszB9mJ4sY5onDsAzsL9ZrZiON5D7WWYsUpl&components=buttons&enable-funding=venmo,paylater"
        data-sdk-integration-source="integrationbuilder_sc"></script>

    <script>
        window.paypal
            .Buttons({

                style: {
                    shape: 'rect',
                    //color:'blue', change the default color of the buttons
                    layout: 'vertical', //default value. Can be changed to horizontal
                },
                async createOrder() {
                    try {
                        const response = await fetch("/api/orders", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                            },
                            // use the "body" param to optionally pass additional order information
                            // like product ids and quantities
                            body: JSON.stringify({
                                cart: [{
                                    id: " $this->order->id ",
                                    quantity: "$this->order->quantity ",

                                }, ],
                            }),
                        });

                        const orderData = await response.json();

                        if (orderData.id) {
                            return orderData.id;
                        } else {
                            const errorDetail = orderData?.details?.[0];
                            const errorMessage = errorDetail ?
                                `${errorDetail.issue} ${errorDetail.description} (${orderData.debug_id})` :
                                JSON.stringify(orderData);

                            throw new Error(errorMessage);
                        }
                    } catch (error) {
                        console.error(error);
                        resultMessage(`Could not initiate PayPal Checkout...<br><br>${error}`);
                    }
                },
                async onApprove(data, actions) {
                    try {
                        if (transaction.status =="completed") {
                                Livewire.dispatch('transactionEmit',transaction.id);
                            }
                        const response = await fetch(`/api/orders/${data.orderID}/capture`, {

                            method: "POST",
                            headers: {

                                "Content-Type": "application/json",
                            },

                        });

                        const orderData = await response.json();
                        // Three cases to handle:
                        //   (1) Recoverable INSTRUMENT_DECLINED -> call actions.restart()
                        //   (2) Other non-recoverable errors -> Show a failure message
                        //   (3) Successful transaction -> Show confirmation or thank you message

                        const errorDetail = orderData?.details?.[0];

                        if (errorDetail?.issue === "INSTRUMENT_DECLINED") {
                            // (1) Recoverable INSTRUMENT_DECLINED -> call actions.restart()
                            // recoverable state, per https://developer.paypal.com/docs/checkout/standard/customize/handle-funding-failures/
                            return actions.restart();
                        } else if (errorDetail) {
                            // (2) Other non-recoverable errors -> Show a failure message
                            throw new Error(`${errorDetail.description} (${orderData.debug_id})`);
                        } else if (!orderData.purchase_units) {
                            throw new Error(JSON.stringify(orderData));
                        } else {
                            // (3) Successful transaction -> Show confirmation or thank you message
                            // Or go to another URL:  actions.redirect('thank_you.html');
                            const transaction =
                                orderData?.purchase_units?.[0]?.payments?.captures?.[0] ||
                                orderData?.purchase_units?.[0]?.payments?.authorizations?.[0];
                            resultMessage(
                                `Transaction ${transaction.status}: ${transaction.id}<br><br>See console for all available details`,
                            );
                            console.log(
                                "Capture result",
                                orderData,
                                JSON.stringify(orderData, null, 2),
                            );
                        }
                    } catch (error) {
                        console.error(error);
                        resultMessage(
                            `Sorry, your transaction could not be processed...<br><br>${error}`,
                        );
                    }
                },
                onClick() {
                    //show a validation error if the checkbox is not checked
                    if (!document.getElementById('fullname').value
                         ||!document.getElementById('phone').value
                        ||!document.getElementById('email').value
                       || !document.getElementById('pincode').value
                        || !document.getElementById('address').value
                        )
                         {
                        Livewire.dispatch('validationForAll');
                        return false;
                    } else {

                        @this.set('fullname', document.getElementById('fullname').value);
                        @this.set('email', document.getElementById('email').value);
                        @this.set('phone', document.getElementById('phone').value);
                        @this.set('pincode', document.getElementById('pincode').value);
                        @this.set('address', document.getElementById('address').value);
                    }
                }
            })
            .render("#paypal-button-container");

        // Example function to show a result to the user. Your site's UI library can be used instead.
        function resultMessage(message) {
            const container = document.querySelector("#result-message");
            container.innerHTML = message;
        }
    </script>

@endpush
