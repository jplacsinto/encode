function makeSlug(name, inputId) {
    const XHR = new XMLHttpRequest(),
        FD  = new FormData();
        FD.append( 'string', name );


    XHR.onload = function() {
      if (XHR.status === 200) document.getElementById(inputId).value = XHR.responseText;
    };

    XHR.open( 'POST', "/api/make-slug" );
    XHR.send( FD );
}