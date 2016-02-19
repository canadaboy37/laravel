<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/t/dt/dt-1.10.11/datatables.min.js"></script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    </head>
    <body>
    <div class="container">
        <div class="row">
            <form role="form" id="product-form">
                <div class="col-lg-6">
                    <div class="well well-sm"><strong>Add new products <span class="glyphicon glyphicon-asterisk"></span>Required Field</strong></div>
                    <div class="form-group">
                        <label for="productname">Enter Product Name</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="productname" id="productname" placeholder="Enter Product Name" required>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="qty">Enter Quantity in Stock</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="qty" name="qty" placeholder="Enter Quantity in Stock" required>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price">Enter Price</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="price" name="price" placeholder="Enter Price" required>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                        </div>
                    </div>
                    <input type="hidden" id="token" name="_token" value="{{{ csrf_token() }}}" />
                    <input type="submit" name="submit" id="submit" value="Add Product" class="btn btn-info pull-right">
                </div>
            </form>
            <BR />
            <div id="message" class="col-md-12">


            </div>
        </div>
        <h2>Product Information</h2>
        <table id="products" class="table table-striped">
            <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity in Stock</th>
                <th>Price</th>
                <th>Created At</th>
                <th>Total Value</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function(){
            $("#products").DataTable({
               "ajax": '/products',
                "bPaginate": false,
                "bFilter": false,
                "bInfo": false
            });

            $("#product-form").submit(function(event){
                event.preventDefault();
                var data = {pname: $("#productname").val(), qty: $("#qty").val(), price: $("#price").val(), _token: $("#token").val()};
                $.post("/add", data, function(response){
                    if(response != "success")
                    {
                        $("#message").html('<div class="alert alert-success"><strong><span class="glyphicon glyphicon-ok"></span> Success! Product added.</strong></div>');
                        $("table tbody").append('<tr><td>'+response.product_name+'</td><td>'+response.qty+'</td><td>'+response.price+'</td><td>'+response.date+'</td><td>'+response.total+'</td></tr>');
                    }else{
                        $("#message").html('<div class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span><strong> Error! Please check all page inputs.</strong></div>');
                    }
                    $('.alert').delay(2000).fadeOut(400);
                });
            });
        });
    </script>
    </body>
</html>
