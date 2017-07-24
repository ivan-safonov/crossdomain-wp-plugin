
function logResults(json){
  console.log(json);
}

jQuery(document).ready(function($){



$.getJSON( "http://localhost:3000/api/visit/" + redirect.id + ".js?callback=?", function(data) {
    console.log(data);
    document.location.href = data['link'];
});

//    request.done(function( data ) {
//      console.log(data['link']);    
//    });

//    request.fail(function( jqXHR, textStatus ) {
//      alert( "Request failed: " + textStatus );
//   });

});


