jQuery(function($) {
  var $bodyEl = $('body'),
      $sidedrawerEl = $('#sidedrawer');
  
  
  // ==========================================================================
  // Toggle Sidedrawer
  // ==========================================================================
  function showSidedrawer() {
    // show overlay
    var options = {
      onclose: function() {
        $sidedrawerEl
          .removeClass('active')
          .appendTo(document.body);
      }
    };
    
    var $overlayEl = $(mui.overlay('on', options));
    
    // show element
    $sidedrawerEl.appendTo($overlayEl);
    setTimeout(function() {
      $sidedrawerEl.addClass('active');
    }, 20);
  }
  
  
  function hideSidedrawer() {
    $bodyEl.toggleClass('hide-sidedrawer');
  }
  
  
  $('.js-show-sidedrawer').on('click', showSidedrawer);
  $('.js-hide-sidedrawer').on('click', hideSidedrawer);
  
  
  // ==========================================================================
  // Animate menu
  // ==========================================================================

  var $titleEls = $('strong', $sidedrawerEl);
  
  $titleEls
    .next()
    .hide();
  
  $titleEls.on('click', function() {
    $(this).next().slideToggle(200);
  });

  $('#edit').on('click', editUserInfo);

  function editUserInfo() {
    $( '.mui-table--information input' ).removeAttr( "disabled" ).addClass('input--white');
    $('#edit').hide();
    $('#save').show();
  }

  $('#save').click(function(){
    // собираем данные с формы
    var fname 	 = $('#fname').val();
    var name 	 = $('#name').val();
    var sname = $('#sname').val();
    var b_date	 = $('#b_date').val();
    var growth 	 = $('#growth').val();
    var address = $('#address').val();
    var address_last 	 = $('#address_last').val();
    var phone = $('#phone').val();

    $.ajax({
      url: "action.php",
      type: "post",
      dataType: "json",
      data: {
        "fname": 	fname,
        "name": 	name,
        "sname": sname,
        "b_date": 	b_date,
        "growth": growth,
        "address": address,
        "address_last": address_last,
        "phone": phone
      },

      success: function(data){
        $('.messages').html('Информация успешно обновлена');
        $('#save').hide();
        $('#edit').show();
      }
    });
  });


  $('#add_parameter').on('click', addNewInfo);

  function addNewInfo() {
    $('.add_show').show();
    $('#add_parameter').hide();
  }



  $('#send-new-user').click(function(){
    // собираем данные с формы
    var fname 	 = $('#fname').val();
    var name 	 = $('#name').val();
    var sname =  $('#sname').val();
    var b_date	 = $('#b_date').val();
    var growth 	 = $('#growth').val();
    var sex = $('#sex').val();


    $.ajax({
      url: "action_new-user.php",
      type: "post",
      dataType: "json",
      data: {
        "fname": 	fname,
        "name": 	name,
        "sname": sname,
        "b_date": 	b_date,
        "growth": growth,
        "sex": sex
      },

      success: function(data){
        $('.messages').html('Информация успешно обновлена');
        $('#save').hide();
        return false;
      }
    });
  });


  $('#login_button').click(function(){
    var login	 = $('#login').val();
    var password	 = $('#password').val();

    $.ajax({
      url: "authorization.php",
      type: "post",
      dataType: "json",
      data: {
        "login": 	login,
        "password": 	password
      },

      success: function(data){
        top.location.href="index.html";
      }
    });
  });

  $('#tablePatients').DataTable();

});
