$(function(){
  $.ajaxSetup({
  headers: {
    'key': '3b336ea639da23a906596cf684b097cd',
    }
  });
   
  $('#search').submit(function(event) {
      event.preventDefault();
      var get_data = $(this).serialize();
      console.log(get_data=>id);
      var url = 'https://api.rajaongkir.com/starter/city?id=39&province=5';
      // console.log(url);
      // console.log(post_data);
      $.ajax({
          url: url,
          type: 'POST',
          data: get_data,
          dataType: "json",
          success:function(data){
            console.log(data);
          },
          error:function(data){
            var parsedData = data;
            swal(
              'Gagal!',
              'Whoops ada kesalahan pada server!',
              'error'
            );
            
          }
      });
  });
});
