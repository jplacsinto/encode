/*function postData( data , url) {
  const XHR = new XMLHttpRequest(),
        FD  = new FormData();

  // Push our data into our FormData object
  for( name in data ) {
    FD.append( name, data[ name ] );
  }

  // Define what happens in case of error
  XHR.addEventListener(' error', function( event ) {
    console.log( 'Oops! Something went wrong.' );
  } );

  // Set up our request
  XHR.open( 'POST', url );

  // Send our FormData object; HTTP headers are set automatically
  XHR.send( FD );
}

var xhr = new XMLHttpRequest();
xhr.open('GET', 'myservice/username?id=some-unique-id');
xhr.onload = function() {
    if (xhr.status === 200) {
        alert('User\'s name is ' + xhr.responseText);
    }
    else {
        alert('Request failed.  Returned status of ' + xhr.status);
    }
};
xhr.send();*/

function makeSlug(sectionName, inputId) {
    const XHR = new XMLHttpRequest(),
        FD  = new FormData();
        FD.append( 'string', sectionName );


    XHR.onload = function() {
      if (XHR.status === 200) document.getElementById(inputId).value = XHR.responseText;
    };

    XHR.open( 'POST', "/api/make-slug" );
    XHR.send( FD );
}