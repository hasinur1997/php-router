<?php
    template('header.php');
?>

<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2 p-3">
            <!-- <form action="/reports" class="d-sm-inline-flex justify-content-between mb-3">
                <input type="date" class="form-control" name="from-date" placeholder="From Date">
            
                <input type="date" class="form-control" name="to-date" placeholder="To Date">
                <input type="submit" class="btn btn-sm btn-primary" value="Filter">
            </form> -->
            <?php if ( ! empty($data['products']) ): ?>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>IP</th>
                            <th>Amount</th>
                            <th>Buyer</th>
                            <th>Entry Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data['products'] as $product): ?>
                            <tr>
                                <td><?php echo $product->buyer_ip; ?></td>
                                <td><?php echo $product->amount; ?></td>   
                                <td><?php echo $product->buyer; ?></td>
                                <td><?php echo $product->entry_at; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            <?php endif; ?>
        </div>
    </div>
</div>

<?php
    template('footer.php');
?>