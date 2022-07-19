<?php
    template('header.php');
?>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3 p-3">
            <h2 class="text-center">Welcome to our app</h2>
            <form action="/hello" method="post" class="store-form">
                <div class="card">
                    <div class="card-header">
                        Create Items
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="amount">Amount</label>
                            <input type="text" class="form-control" name="amount" id="amount"/>
                        </div>

                        <div class="form-group mb-3">
                            <label for="buyer">Buyer</label>
                            <input type="text" class="form-control" name="buyer" id="buyer"/>
                        </div>

                        <div class="form-group mb-3">
                            <label for="receipt_id">Receipt Id</label>
                            <input type="text" class="form-control" name="receipt_id" id="receipt_id"/>
                        </div>

                        <div class="form-group mb-3">
                            <label for="items">Items</label>
                            <input type="text" class="form-control" name="items" id="items"/>
                        </div>

                        <div class="form-group mb-3">
                            <label for="buyer_email">Buyer Email</label>
                            <input type="text" class="form-control" name="buyer_email" id="buyer_email"/>
                        </div>

                        <div class="form-group mb-3">
                            <label for="note">Note</label>
                            <textarea name="note" id="note" cols="30" rows="3" class="form-control"></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="city">City</label>
                            <input type="text" class="form-control" name="city" id="city"/>
                        </div>

                        <div class="form-group mb-3">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" name="phone" id="phone"/>
                        </div>
                        <div class="form-group mb-3">
                            <label for="entry_at">Entry At</label>
                            <input type="text" class="form-control" name="entry_at" id="entry_at" readonly value="<?php echo date('Y-m-d'); ?>"/>
                        </div>
                        <div class="form-group mb-3">
                            <label for="entry_by">Entry By</label>
                            <input type="text" class="form-control" name="entry_by" id="entry_by"/>
                        </div>
                        <div class="mb-3">
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    template('footer.php');
?>