window.addEventListener('beforeunload', function() {
   $('button[type=submit]').attr('disabled', 'disabled'); 
});

function confirmDelete(link) {
    if (confirm("Are you sure you want to delete")) {
        window.location = link;
    }
    return false;
}    

$(function() {
    
    $('button[type=submit]').removeAttr('disabled');
    $('form .first-focus').focus();
    
    // Apply Parsley Validation
    var form = $('form').parsley()
    
        email = $('input[name=email]')
        password = $('input[name=password]')
        password_confirm = $('input[name=password_confirmation]')
        current_password = $('input[name=current_password]')
        contact_number = $('input[name=contact_number]')
        firstname = $('input[name=firstname]')
        lastname = $('input[name=lastname]')
        middlename = $('input[name=middlename]')
        address = $('input[name=address]')
        gender = $('select[name=gender], input[name=gender]')
        birthdate = $('input[name=birthdate]')
        
        title = $('input[name=title]')
        author = $('input[name=author]')
        isbn = $('input[name=isbn]')
        quantities = $('input[name=quantities]')
        shelf_location = $('input[name=shelf_location]')
        
        captcha = $('input[name=g-recaptcha-response]');
    
    /**
     * Manage Member Form
     */
    email.attr('required', 'required')
         .attr('maxlength', '200');
    
    current_password.attr('required', 'required')
            .attr('minlength', '6');
    
    password.attr('required', 'required')
            .attr('minlength', '6');
    
    password_confirm.attr('required', 'required')
                    .attr('data-parsley-equalto', 'input[name=password]');
                    
    contact_number.attr('required', 'required')
                  .attr('maxlength', '20')
                  .attr('minlength', '7');
                  
    firstname.attr('required', 'required')
             .attr('maxlength', '60')
             .attr('minlength', '3');
             
    lastname.attr('required', 'required')
            .attr('maxlength', '60')
            .attr('minlength', '3');
            
    middlename.attr('maxlength', '60')
              .attr('minlength', '1');
              
    address.attr('required', 'required')
           .attr('maxlength', '200')
           .attr('minlength', '3');
           
    gender.attr('required', 'required')
          .attr('data-parsley-errors-container', '#gender-error');
    
    birthdate.attr('required', 'required');
    
    /**
     * Manage Book Form
     */
    title.attr('required', 'required')
         .attr('maxlength', '100')
         .attr('minlength', '3');
    
    author.attr('required', 'required')
          .attr('maxlength', '60')
          .attr('minlength', '3');
    
    isbn.attr('required', 'required')
            .attr('maxlength', '20')
            .attr('minlength', '3');
    
    quantities.attr('required', 'required')
            .attr('data-parsley-type', 'number')
            .attr('maxlength', '11')
            .attr('min', '1');
    
    shelf_location.attr('required', 'required')
            .attr('maxlength', '100')
            .attr('minlength', '3');
    
    /**
     * Escape Error Message for Login Form
     */
    $('#login input[name=email]').attr('data-parsley-required-message', '')
                                 .attr('data-parsley-type-message', '');
                                 
    $('#login input[name=password]').attr('data-parsley-required-message', '')
                                    .removeAttr('minlength');
        
    var handleDataTableButtons = function() {
      if ($("#datatable-buttons").length) {
        $("#datatable-buttons").DataTable({
          dom: "Bfrtip",
          buttons: [
            {
              extend: "copy",
              className: "btn-sm"
            },
            {
              extend: "csv",
              className: "btn-sm"
            },
            {
              extend: "excel",
              className: "btn-sm"
            },
            {
              extend: "pdfHtml5",
              className: "btn-sm"
            },
            {
              extend: "print",
              className: "btn-sm"
            },
          ],
          responsive: true
        });
      }
    };

    TableManageButtons = function() {
      "use strict";
      return {
        init: function() {
          handleDataTableButtons();
        }
      };
    }();

    $('#datatable').dataTable();

    $('#datatable-keytable').DataTable({
      keys: true
    });

    $('#datatable-responsive').DataTable();

    $('#datatable-scroller').DataTable({
      ajax: "js/datatables/json/scroller-demo.json",
      deferRender: true,
      scrollY: 380,
      scrollCollapse: true,
      scroller: true
    });

    $('#datatable-fixed-header').DataTable({
      fixedHeader: true
    });

    TableManageButtons.init();    
    
    
});