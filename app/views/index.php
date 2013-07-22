<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>WS Example in PHP using Ratchet</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    
    <div class="container">
        <div class="col-6">
        <h2>Push</h2>
        <form id="ws-form" action="<?php echo $baseUrl; ?>" method="post">
            <input type="hidden" name="type" id="type" value="new-client">
            <input type="text" name="client" id="client">
            <input id="ws-submit" class="btn btn-default" type="submit" value="Push">
        </form>
            
        </div>
    </div>
    
    <script src="js/jquery.min.js"></script>
    <script src="http://autobahn.s3.amazonaws.com/js/autobahn.min.js"></script>
    <script>

        var BASE_URL = '<?php echo $baseUrl; ?>';

        $(function() {
            $('#ws-form').on('submit', function(e) {
                e.preventDefault();
                $.ajax({type: 'post', url: BASE_URL, data: $(this).serializeArray() });
            });
        });

        var conn = new ab.Session(
            'ws://127.0.0.1:8080' // The host (our Ratchet WebSocket server) to connect to
          , function() {            // Once the connection has been established
                conn.subscribe('new-client', function(topic, data) {
                    // This is where you would add the new article to the DOM (beyond the scope of this tutorial)
                    console.log('New client: ' + data.client);
                });
            }
          , function() {            // When the connection is closed
                console.warn('WebSocket connection closed');
            }
          , {                       // Additional parameters, we're ignoring the WAMP sub-protocol for older browsers
                'skipSubprotocolCheck': true
            }
        );
    </script>
</body>
</html>