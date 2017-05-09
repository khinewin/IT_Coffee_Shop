$(function () {

    getOrders();
    setInterval(function () {
        getOrders();
    }, 10000);

    $("#btnInvoiceSearch").on('click', function () {
        var id=$("#searchByID").val();

        $.ajax({
            type: 'get',
            url: 'getOrders',
            data : {id:id},
            success:function (msg) {
                $("#showOrders").html(msg);
            }
        });

    });

    $("body").delegate('#btnCashed', 'click', function () {
       var id=$(this).attr('idd');
       var u_t=$(this).attr('u_t');
       $.ajax({
          type : 'get',
           url :'order-update',
           data : { id :id, u_t:u_t},
           success:function (msg) {
              if(msg==='success'){
                  getOrders();
              }
           }
       });
    });

   $("body").delegate('#btnDelivered', 'click', function () {
      var id=$(this).attr('idd');
      var u_t=$(this).attr('u_t');
      $.ajax({
         type:'get',
          url : 'order-update',
          data : {id:id, u_t:u_t},
          success:function (msg) {
              if(msg==='success'){
                  getOrders();
              }
          }
      });

   });


    function getOrders() {
        $.ajax({
           type: 'get',
            url: 'getOrders',
            success:function (msg) {
                $("#showOrders").html(msg);
            }
        });

    }
    showOrderForHome();
    function showOrderForHome() {
        $.ajax({
            type: 'get',
            url: 'getOrders',
            success:function (msg) {
                $("#showOrders").html(msg);
            }
        });

    }
    getCart();
    function getCart() {
        $.ajax({
            type: 'get',
            url :'getCart',
            success:function (msg) {
                $("#getCart").html(msg);
            }
        });

    }

    $("body").delegate('#btnAddToCart', 'click', function () {
       var id=$(this).attr('idd');
       $.ajax({
          type: 'get',
           url :'add-to-cart',
           data : {id:id},
           success:function () {
            getCart();
           }
       });
    });

    $("#btnSaveCat").on('click', function () {

        var _token=$("#_token").val();
        var category_name=$("#category_name").val();
        $.ajax({
            type: 'post',
            url :'new-category',
            data : {category_name:category_name, _token:_token},
            success:function (msg) {
                $("#newCatInfo").html(msg);
                if(msg==="<li class='alert alert-success'><span class='glyphicon glyphicon-ok-circle'></span> The new category have been save.</li>"){
                   setInterval(function () {
                       window.location.reload();
                   },2000);
                }
            }
        });
    });

    $("#btnLogout").on('click', function () {
        $.ajax({
           type : 'get',
            url : '../auth/logout',
            success:function (msg) {
               console.log(msg);
                if(msg==='logoutSuccess'){
                    window.location.replace('/auth/login');
                }
            }
        });
    });

    $("#btnLogin").on('click', function () {
       var userName=$('#userName').val();
        var password=$("#password").val();
        var _token=$("#_token").val();
        $.ajax({
            type: 'post',
            url : 'login',
            data : {userName:userName, password:password, _token:_token},
            success:function (msg) {
                $("#authInfo").html(msg);
                if(msg==="<li class='alert alert-success'><span class='glyphicon glyphicon-ok-circle'></span> Authorized Successed.</li>"){
                    setInterval(function () {
                        window.location.replace('/dashboard');
                    }, 2000)
                }

            }
        });
    });

    $("#btnReg").on('click', function () {
        var userName=$('#userName').val();
        var email=$("#email").val();
        var password=$("#password").val();
        var password_confirm=$("#password_confirm").val();
        var _token=$("#_token").val();
        $.ajax({
            type: 'post',
            url : 'register',
            data : {userName:userName, email:email, password:password, password_confirm:password_confirm, _token:_token},
            success:function (msg) {
                $("#authInfo").html(msg);
                if(msg==="<li class='alert alert-success'><span class='glyphicon glyphicon-ok-circle'></span> The user account have been created.</li>"){
                    setInterval(function () {
                        window.location.replace('/auth/login');
                    }, 2000)
                }

            }
        });
    });
});