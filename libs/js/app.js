    const addContactPath    = '../Vocala/libs/php/createContact.php';
    const deleteContactPath = '../Vocala/libs/php/deleteContact.php';
    const editContactPath   = '../Vocala/libs/php/editContact.php';
    const searchPath        = '../Vocala/libs/php/getSearchResults.php';
    const getAllPath        = "../Vocala/libs/php/getAllContacts.php";
    const getByIdPath       = "../Vocala/libs/php/getContactById.php";

    let contactId;

    $( document ).on( 'keyup', '#contact-search', function() {
        const searchValue = $( this ).val();
        const data = { data: searchValue };
        request( searchPath, 'html', append, data );
    } );

    $( document ).on( 'search', '#contact-search', function() {
        const searchValue = $( this ).val();
        const data = { data: searchValue };
        request( searchPath, 'html', append, data );
    } );

    $( "#add-contact-form" ).on( "submit", function( event ) {
        event.preventDefault();
        const data = $( this ).serialize(); 
        request( addContactPath, 'json', addSuccess, data );
      });

      $( '.delete-contact' ).on( 'click', function() {
          getContact( $( this ), appendDeletMsg );
      });

      $( '#confirm-delete' ).on( 'click', function(e) {
        e.preventDefault();
        const data = { id: contactId };
        request( deleteContactPath, "json", deleteSuccess, data );
      });

      $( '.edit-contact' ).on( 'click', function() {
            getContact( $( this ), appendEdit )
      });

      $( '#edit-contact-form' ).on( 'submit', function( e ) {
        e.preventDefault();
        const data = { 
            id: contactId,
            firstName: $( '#edit-first' ).val(),
            secondName: $( '#edit-second' ).val(),
            phone: $( '#edit-phone' ).val(),
            email: $( '#edit-email' ).val(),
         };
        request( editContactPath, "json", editSuccess, data );
      });


    //AJAX
     function request( path, response, callback = null, data ){
        $.ajax({
            url: path,
            type: "POST",
            dataType: response,
            data: data,
            success: ( result ) => {
                if ( callback !== null ) return callback( result );
                return result;
            },
            error: ( jqXHR, textStatus, errorThrown ) => error( jqXHR, textStatus, errorThrown )
        });
    }

    function getContact( element, callback ) {
        contactId = $( element ).data( 'contactid' );
        const data = { id: contactId };
        request( getByIdPath, "json", callback, data );  
    }

    //MODALS
    function clearModal( code, modal ) {
        if( code == "200" ) $( modal ).modal( "hide" );
    }

    //TOASTS
    function toast( result ) {
        if( result.status.code == "200" ) {
            return $.toast({
            type: 'success',
            title: result.status.name,
            subtitle: 'Just now',
            content: result.status.description,
            delay: 1500
        });
        }
        return  $.toast({
            type: 'error',
            title: result.status.name,
            subtitle: 'Just now',
            content: result.status.description,
            delay: 1500
        });
    }

    //APPEND RESULTS
    function append( result ) {
        $( '.display-contact' ).html( result );
    }

    function appendDeletMsg( result ) {
        $( '#delete-contact-name' ).html( `Delete ${ result.data[0].firstName }
         ${ result.data[0].lastName } ?` );
    }

    function deleteSuccess( result ) {
        contactId = null;
        toast( result ); 
        clearModal( result.status.code, $( '#delete-contact-modal' ) );
        refresh();
    }

    function editSuccess( result ) {
        contactId = null;
        toast( result ); 
        clearModal( result.status.code, $( '#edit-contact-modal' ) );
        refresh();
    }

    function addSuccess( result ) {
        toast( result ); 
        clearModal( result.status.code, $( '#add-contact-modal' ) );
        refresh();
    }
    
    function appendEdit( result ) {
        $( '#edit-first' ).val( result.data[0].firstName );
        $( '#edit-second' ).val( result.data[0].lastName );
        $( '#edit-phone' ).val( result.data[0].phone );
        $( '#edit-email' ).val( result.data[0].email );
    }
                
    //ERROR
    function error( jqXHR, textStatus, errorThrown ) {
        console.log( jqXHR );
        console.log( textStatus );
        console.log( errorThrown );
    }

    //REFRESH RESULTS
    function refresh() {
        $( '#contact-search' ).trigger( 'search' );
    }
